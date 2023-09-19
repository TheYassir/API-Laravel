<?php

namespace App\Http\Controllers;

use \App\Models\Argument;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $arguments = Argument::all();

        return view('index', [
            'arguments' => $arguments
        ]);
    }

    public function newsletter(Request $request) {
        //Nous validons la valeur envoyée via requête POST
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers|max:255'
        ]);

        //On prépare un nouvel inscrit
        $subscriber = new Subscriber();
        //Si la clé 'email' a bien été validée, on peut y accéder
        //dans $validated
        $subscriber->email = $validated['email'];
        //Enregistrement du nouvel inscrit
        $subscriber->save();

        /*
        Autre possibilité pour créer le nouveau subscriber
        $subscriber = Subscriber::create([
            'email' => $validated['email']
        ])
        */

        //Après création, on redirige vers l'index
        //avec un message stocké dans une variable de session "status"
        return redirect()->route('index')
                         ->with('status', 'Vous êtes maintenant abonné(e) à la newsletter. Merci !');
    }

    //Méthode non appelée, c'est de la documentation !
    public function demoArguments() {
        //Création d'un nouvel Argument
        $argument = new Argument();
        $argument->title = 'New argument title';
        $argument->body = 'Argument body bla bla';
        $argument->save();

        //Récupération de tous les arguments
        $arguments = Argument::all();

        //Récupération de l'argument avec un ID de 1
        $firstArgument = Argument::find(1);
    }

    //Méthode non appelée, c'est de la documentation !
    public function demoUpdateDelete() {
        //Modifier un modèle
        $movie = \App\Models\Movie::find(5);
        $movie->duration = 3600;
        $movie->save();

        //Supprimer un modèle
        $movie->delete();
    }
}
