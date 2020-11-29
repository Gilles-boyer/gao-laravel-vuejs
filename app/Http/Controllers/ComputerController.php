<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ComputerCollection;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date)
    {
        $request = ['date' => $date];

        $validator = Validator::make(
            $request,
            [
                'date' => 'required|date',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'      => true,
                'errorList'  => $validator->errors()
            ]);
        }

        $computers = Computer::with(['attributions' => function ($query) use ($date) {
            $query->where('date', $date);
        }])->paginate(4);

        return ComputerCollection::collection($computers);
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
                'name' => 'required|string|max:100',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'      => true,
                'errorList'  => $validator->errors()
            ]);
        }

        $computer = new Computer();

        $computer->name = $request->name;

        $result = $computer->save();

        $computers = Computer::all();

        if ($result) {
            return response()->json([
                'error'  => false,
                'message'   => "L'ordinateur est créé",
                'computers' => ComputerCollection::collection($computers)
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
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Computer $computer, $id)
    {
        $request = ['id' => $id];

        $validator      =       Validator::make(
            $request,
            [
                'id'       => 'required|exists:computers,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'      => true,
                'errorList'  => $validator->errors()
            ]);
        }

        $verify = $computer->find($id)->delete();

        if ($verify) {
            return response()->json([
                'error'  => false,
                'message'   => "L'ordinateur est supprimé",
            ], 200);
        } else {
            return response()->json([
                'error'  => true,
                'errorList'   => 'un problème est survenu dans la suppression',
            ], 422);
        }
    }
}
