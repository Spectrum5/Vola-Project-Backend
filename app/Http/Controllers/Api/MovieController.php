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
        $client = new Client();
        if ($request['title'] != '')  {
            $title = $request['title'];
            $pages = $request['page'];
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=151c60c1&s='.$title."&page=".$pages);
        }
        elseif ($request['id'] != null) {
            $id = $request['id'];
            $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=151c60c1&i='.$id);
        }

        if ($res->getStatusCode() == 200) { // 200 OK
            $response = $res->getBody()->getContents();
            $responseDecode = json_decode($response);
        }
        return response()->json($responseDecode);
    }

}
