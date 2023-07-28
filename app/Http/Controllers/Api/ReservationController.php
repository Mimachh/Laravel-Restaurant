<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TestTelegram;
use App\Mail\Reservation as MailReservation;
use App\Mail\ReservationAdmin as ReservationAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;

use App\Models\Validation;
use App\Models\Couvertsrestants;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Http;
class ReservationController extends Controller
{
    public function store(Request $request) {
    
        $adminEmail = env('MAIL_ADMIN', 'default_admin@example.com');


        $validator = Validator::make($request->all(), [
            'date' => 'required|string|max:60',
            'service' => 'required|string|max:60',
            'creneau' => 'required|string|max:60',
            'convives' => 'required|integer|min:0',
            'nom' => 'required|string|max:60',
            'prenom' => 'required|string|max:60',
            'mail' => 'required|email|max:60',
            'telephone' => 'nullable|string|max:10',
            'informations' => 'nullable|string|max:255',
            'regles' => 'required|boolean',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $cleanedData = $validator->validated();
        
        // $cleanedDate
        // $cleanedService
        // $cleanedConvives
        // $cleanedNom = strip_tags(trim($validator['nom']));
        // $cleanedPrenom
        // $cleanedMail
        // $cleanedTel
        // $cleanedInformations
        // $cleanedRegles

        // Tous les champs dans reservation

        $validation = Validation::first();



        // Vérifier si validation automatique ou non
        $validation_auto = $validation->is_automatic_validation;
        $validation_auto_status = "";

        $validation_is_add_manual_validation = $validation->is_add_manual_validation;
        $number_limit_validation = 0;
        if(isset($validation->manual_limit_validation)) {
            $number_limit_validation = $validation->manual_limit_validation;
        } else {
            $number_limit_validation = 0;
        }

        if($validation_auto == '1') {
            if($validation_is_add_manual_validation == '1' && intval($cleanedData['convives']) >= intval($number_limit_validation) ) {
                $validation_auto_status = 2;
            } else {
                $validation_auto_status = 1;
            }
        } else {
            $validation_auto_status = 2;
        }




        

        // ENREGISTREMENT RESERVATION
        $reservation = new Reservation();
        $reservation->date = $cleanedData['date'];
        $reservation->service = $cleanedData['service'];
        $reservation->creneau = $cleanedData['creneau'];
        $reservation->convives = $cleanedData['convives'];
        $reservation->nom = $cleanedData['nom'];
        $reservation->prenom = $cleanedData['prenom'];
        $reservation->email = $cleanedData['mail'];
        $reservation->telephone = $cleanedData['telephone'];
        $reservation->informations = $cleanedData['informations'];
        $reservation->regles = $cleanedData['regles'];
        $reservation->status = $validation_auto_status;


        $reservationMailable = array(
            'date' => $cleanedData['date'],
            'service' => $cleanedData['service'],
            'creneau' => $cleanedData['creneau'],
            'convives' => $cleanedData['convives'],
            'nom' => $cleanedData['nom'],
            'prenom' => $cleanedData['prenom'],
            'email' => $cleanedData['mail'],
            'telephone' => $cleanedData['telephone'],
            'informations' => $cleanedData['informations'],
            'status' => $validation_auto_status
        );

                // Vérifier pour le mail
                $validation_is_mail = $validation->is_email_confirmation;
                if($validation_is_mail == '1') {
                    // Mail::to($cleanedData['mail'])->send(new MailReservation($reservationMailable));
                } 

        // NOTIF POUR L'ADMIN 
        // Mail::to($adminEmail)->send(new ReservationAdmin($reservationMailable));
        $validation_auto_status_traduit_pour_telegram = "";
        if($validation_auto_status == 1) {
            $validation_auto_status_traduit_pour_telegram = "nouvelle réservation";
        } else if ($validation_auto_status == 2) {
            $validation_auto_status_traduit_pour_telegram = "réservation en attente de validation";
        }
        $dataToTelegram = "Vous avez reçu une " . $validation_auto_status_traduit_pour_telegram . " pour " . $cleanedData['convives'] . " personnes. Réservation pour le " . $cleanedData['date'] . " " . $cleanedData['service'];
        $telegramController = new TestTelegram();
        $response = $telegramController->sendMessageToTelegram($dataToTelegram);

        // Verifier si déjà une entrée dans la table de calcul de couverts restants
        $nomDeLaTableCouvertsRestants = $request->nomPourTableCouvertsRestants;

        $couvertsRestantsTableExists = CouvertsRestants::where('nom', $nomDeLaTableCouvertsRestants)->first();
        if($couvertsRestantsTableExists) {
            // UPDATE
            $nbCouvertsRestants = $couvertsRestantsTableExists->couverts_restants;
            if($nbCouvertsRestants) {
                $nbCouvertsRestants -= intval($cleanedData['convives']);
            } 

            if($nbCouvertsRestants >= 0) {


                $reservation->save();

                if($validation_auto_status === 1) {
                    $couvertsRestantsTableExists->couverts_restants = $nbCouvertsRestants;
                    $couvertsRestantsTableExists->save();

                    return response()->json([
                        'message' => 'Réservation enregistrée avec succès.'
                    ], 200);
                } else if ($validation_auto_status === 2) {
                    return response()->json([
                        'message' => 'Votre réservation à bien été reçu, nous vous répondrons au plus vite par mail.'
                    ], 200);
                }

            } else {
                return response()->json([
                    'error' => 'Désolé nous n\'avons plus de place disponible.',
                ], 422);
            }



        } else {
            // ICI IL FAUT CREER LA TABLE EN INDIQUANT LE NOMBRE DE COUVERTS DE BASE
            // Calcul du nombre de couverts restant
            $nombreCouvertsRestantsApresCalcul = null;
            if($request->nombreCouvertsRestants) {
                $nombreCouvertsRestantsApresCalcul = $request->nombreCouvertsRestants - intval($cleanedData['convives']);
            } else {
                $nombreCouvertsRestantsApresCalcul = null;
            }
            
            $reservation->save();

            // En fonction de la validation auto (1) ou manuelle (2)
            if($validation_auto_status === 1) {

                $calculCouvertsRestants = new Couvertsrestants();
                $calculCouvertsRestants->nom = $request->nomPourTableCouvertsRestants;
                $calculCouvertsRestants->couverts_restants = $nombreCouvertsRestantsApresCalcul;
                $calculCouvertsRestants->save();

                return response()->json([
                    'message' => 'Réservation enregistrée avec succès.'
                ], 200);
            } else if ($validation_auto_status === 2) {
                return response()->json([
                    'message' => 'Votre réservation à bien été reçu, nous vous répondrons au plus vite par mail.'
                ], 200);
            }
        }




    }
}
