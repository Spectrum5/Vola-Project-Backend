<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Exception;

// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Crea un nuovo oggetto client HTTP
        $client = new Client();

        // Se è presente il parametro 'title' nella richiesta
        if ($request['title'] != '') {

            // Imposta il valore della variabile $title e $pages
            $title = $request['title'];
            $pages = $request['page'];

            // Effettua una richiesta GET all'API di OMDB per ottenere un elenco di film con il titolo specificato e la paginazione
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=151c60c1&s='.$title."&page=".$pages);
        }

        // Altrimenti, se è presente il parametro 'id' nella richiesta
        elseif ($request['id'] != null) {
            // Imposta il valore della variabile $id
            $id = $request['id'];
            // Effettua una richiesta GET all'API di OMDB per ottenere i dettagli di un film specifico
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=151c60c1&i='.$id);
        }

        // Se la richiesta HTTP ha successo (codice di stato 200)
        if ($res->getStatusCode() == 200) {
            // Ottieni il contenuto della risposta e decodificalo come JSON
            $response = $res->getBody()->getContents();
            $responseDecode = json_decode($response);
        }

        // Restituisci una risposta JSON contenente i risultati della richiesta
        return response()->json($responseDecode);
    }
}
