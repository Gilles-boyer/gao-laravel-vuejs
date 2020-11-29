<?php

namespace App\Http\Controllers;

use App\Models\Attribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AttributionCollection;

class AttributionController extends Controller
{
    public function index()
    {
        $attributions = Attribution::All();

        return AttributionCollection::collection($attributions);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator      =       Validator::make(
            $request->all(),
            [
                'computer_id'       => 'required|exists:computers,id',
                'client_id'         => 'required|exists:clients,id',
                'date'              => 'required|date',
                'time'              => 'required|numeric',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'      => true,
                'errorList'  => $validator->errors()
            ]);
        }

        $attribution = new Attribution();

        $attribution->computer_id = $request->computer_id;
        $attribution->client_id = $request->client_id;
        $attribution->date = $request->date;
        $attribution->time = $request->time;

        $verify = $attribution->save();

        if ($verify) {
            return response()->json([
                'error'  => false,
                'message'   => "L'attribution est créée",
            ], 200);
        } else {
            return response()->json([
                'error'  => true,
                'errorList'   => 'un problème est survenu dans la création',
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribution  $attribution
     * @param   it's ID of \Attribution $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribution $attribution, $id)
    {
        $request = ['id' => $id];

        $validator      =       Validator::make(
            $request,
            [
                'id'       => 'required|exists:attributions,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'      => true,
                'errorList'  => $validator->errors()
            ]);
        }

        $verify = $attribution->find($id)->delete();

        if ($verify) {
            return response()->json([
                'error'  => false,
                'message'   => "L'attribution est supprimée",
            ], 200);
        } else {
            return response()->json([
                'error'  => true,
                'errorList'   => 'un problème est survenu dans la suppression',
            ], 422);
        }
    }
}
