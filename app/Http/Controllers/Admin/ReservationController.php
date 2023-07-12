<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Couvertsrestants;
use Illuminate\Http\Request as Request2;
use App\Models\Reservation;
use App\Models\Jour;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;


class ReservationController extends Controller
{
    public function index()
    {
        $this->authorize('view', Reservation::class);

        $reservations = Reservation::orderBy('date')->get();

        $groupedReservations = $reservations->groupBy('date')->sort(function ($reservationsA, $reservationsB) {
            $dateA = DateTime::createFromFormat('d-m-Y', $reservationsA->first()->date);
            $dateB = DateTime::createFromFormat('d-m-Y', $reservationsB->first()->date);
    
            return $dateA <=> $dateB;
        });
    
        // Trier les réservations par service pour chaque date
        foreach ($groupedReservations as $date => $reservations) {
            $groupedReservations[$date] = $reservations->groupBy('service');
        }

        $currentPage = Request::get('page') ?: 1;
        $perPage = 10;
    
        $paginatedGroupedReservations = new LengthAwarePaginator(
            $groupedReservations->forPage($currentPage, $perPage),
            $groupedReservations->count(),
            $perPage,
            $currentPage,
            ['path' => Request::url()]
        );
        
    
        return view('admin.reservation.index', compact('paginatedGroupedReservations'));
    }




    public function a_venir($date, $service) {

        $this->authorize('view', Reservation::class);

        $reservations = Reservation::where('date', $date)->where('service', $service)->get();
        $status = 1;


        return view('admin.reservation.a_venir', [
            'reservations' => $reservations,
            'date' => $date,
            'service' => $service,
            'status' => $status
        ]);
    }

    public function date_service_status($date, $service, $status) {

        $this->authorize('view', Reservation::class);

        $reservations = Reservation::where('date', $date)->where('service', $service)->where('status', $status)->get();

        return view('admin.reservation.a_venir', [
            'reservations' => $reservations,
            'date' => $date,
            'service' => $service,
            'status' => $status
        ]);
    }

    public function show(string $id) {

        $this->authorize('view', Reservation::class);

        $reservation = Reservation::find($id);

        return view('admin.reservation.show', compact('reservation'));
    }

    public function edit(string $id) {

        $this->authorize('update', Reservation::class);

        $reservation = Reservation::findOrFail($id);
        $reservations = Reservation::all();

  
        return view('admin.reservation.edit', compact('reservation', 'reservations'));
    }

    public function update(Request2 $request, $id) {

        $this->authorize('update', Reservation::class);

        $reservation = Reservation::findOrFail($id);
        $erreurPasAssezDeCouverts = null; 


        
        // Savoir si la table existe
            $prefix = "";
            if($reservation->service === "midi") {
                $prefix = "AM";
            } else if($reservation->service === "soir") {
                $prefix = "PM";
            }
            $nomAvecPrefix = $prefix . "+" . $reservation->date;

            $dataCouvertsRestants = Couvertsrestants::where('nom', $nomAvecPrefix)->first();

            if($dataCouvertsRestants) {
                // Soit on passe de 2 ou 3 à 1 et il faut décrementer la table + api pour calculer en live le nombre restant + refuser si plus petit que 0.
                if(($reservation->status == 2 || $reservation->status == 3) && $request->status == 1) {
                    $nouveauResultat = $dataCouvertsRestants->couverts_restants - $reservation->convives;
                    if($nouveauResultat < 0) {
                        $erreurPasAssezDeCouverts = 1;
                        return redirect()->back()->with('error', 'Il n\'y a pas assez de place disponible.');
                    }

                    if($erreurPasAssezDeCouverts != 1) {
                        $dataCouvertsRestants->couverts_restants = $nouveauResultat;
                        $dataCouvertsRestants->save();
                    }
                    // Mail
                    
                }
                // Soit on passe de 1 à 2 ou 3 et il faut incrémenter la table qui existe forcément et si c'était la seule entrée il faut supprimer la ligne
                if($reservation->status == 1 && $request->status == 2) {
                    $nouveauResultat = $dataCouvertsRestants->couverts_restants + $reservation->convives;
                    $dataCouvertsRestants->couverts_restants = $nouveauResultat;
                    $dataCouvertsRestants->save();
                    // Mail

                } else if($reservation->status == 1 && $request->status == 3) {
                    $nouveauResultat = $dataCouvertsRestants->couverts_restants + $reservation->convives;
                    $dataCouvertsRestants->couverts_restants = $nouveauResultat;
                    $dataCouvertsRestants->save();
                    // Mail
                }
                
            } else {
   
                if($reservation->status != 1) {
                    $date = Carbon::createFromFormat('d-m-Y', $reservation->date);
                    $jourIndex = $date->format('w');
                    if($jourIndex === "0") {
                        $jourIndex = "7";
                    }
                    $jour = Jour::where('id', $jourIndex)->first();
                    $couvertsRestantsDeBase = "";
                    if($reservation->service === "midi") {
                        $couvertsRestantsDeBase = $jour->couverts_midi;
                    } else if ($reservation->service === 'soir') {
                        $couvertsRestantsDeBase = $jour->couverts_soir;
                    }
                    $nouvelleEntree = new Couvertsrestants();
                    $nouvelleEntree->nom = $nomAvecPrefix;
                    $nouvelleEntree->couverts_restants = $couvertsRestantsDeBase - $reservation->convives; 

                    if($nouvelleEntree->couverts_restants < 0) {
                        $erreurPasAssezDeCouverts = 1;
                        return redirect()->back()->with('error', 'Il n\'y a pas assez de place disponible.');
                    } 
                    $nouvelleEntree->save();

                    // Mail
                }
            }





        if($erreurPasAssezDeCouverts == 1) {
            
            return redirect()->back()->with('error', 'Il n\'y a pas assez de place disponible.');

        } else if($erreurPasAssezDeCouverts == 0) {
            
            $reservation->status = $request->status;
            $reservation->save();
    
            $previousUrl = $request->input('previous_url');
            $cleanedPreviousUrl = URL::to($previousUrl);
    
            if ($cleanedPreviousUrl === route('admin.attente.index') || 
            $cleanedPreviousUrl === route('admin.attente.show', $id) ||
            $cleanedPreviousUrl === route('admin.attente.byDate', ['date' => $reservation->date, 'service' => $reservation->service])) {

                return redirect()->route('admin.attente.index')->with('success', 'Le statut à bien été changé.');

            } elseif ($cleanedPreviousUrl === route('admin.reservations.a_venir.show', $id) || 
            $cleanedPreviousUrl === route('admin.reservations.date.service', 
            ['date' => $reservation->date, 'service' => $reservation->service])) {

                return redirect()->route('admin.reservations.date.service', ['date' => $reservation->date, 'service' => $reservation->service])->with('success', 'Le statut à bien été changé.');
            
            }

            return redirect()->route('admin.reservations.date.service', ['date' => $reservation->date, 'service' => $reservation->service])->with('success', 'Le statut à bien été changé.');
        
        
        }

    }




}
