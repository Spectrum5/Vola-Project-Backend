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

        $title = 'superman';
        $res = $client->request('GET', 'http://www.omdbapi.com/?apikey=151c60c1&s='.$title);

        if ($res->getStatusCode() == 200) { // 200 OK
            $response_data = $res->getBody()->getContents();
        }
        else {$response_data = ["message" => 'Not Found'];}
        return response()->json($response_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }
}