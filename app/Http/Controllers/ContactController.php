<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
{
    // dd($request);
    // Valider les données du formulaire
    $validator = Validator::make($request->all(), [
        'nom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'message' => 'required|string',
        'rules' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator) // Associer les messages d'erreur au formulaire
            ->withInput(); // Renvoyer les données saisies par l'utilisateur au formulaire
    }

    // Nettoyer les données avant de les enregistrer dans la base de données
    $nom = trim($request->input('nom'));
    $email = trim($request->input('email'));
    $phone = trim($request->input('phone'));
    $message = strip_tags(trim($request->input('message')));
    $rules = $request->input('rules');

    // Créer une nouvelle instance du modèle Contact avec les données nettoyées du formulaire
    $contact = new Contact([
        'nom' => $nom,
        'email' => $email,
        'phone' => $phone,
        'message' => $message,
        'rules' => $rules,
    ]);

    // Sauvegarder le contact dans la base de données
    $contact->save();

    // Rediriger l'utilisateur vers une page de confirmation par exemple
    return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');

}
}
