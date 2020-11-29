<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\ClientCollection;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::All();

        return ClientCollection::collection($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nickName' => 'required|string|max:100',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'      => true,
                'errorList'  => $validator->errors()
            ]);
        }

        $client = new Client;

        $client->nickName = $request->nickName;

        $verify = $client->save();



        if ($verify) {
            return response()->json([
                'error'     => false,
                'message'   => 'le client est créé',
                'ClientId'  => $client->id
            ], 200);
        } else {
            return response()->json([
                'error'     => true,
                'message'   => "le client n'est pas créé"
            ], 422);
        }
    }
}
