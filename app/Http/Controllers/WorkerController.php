<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $worker = Worker::all();
        return response()->json($worker);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $rules = [
             'name' => 'required|string|max:60',
             'last_name' => 'required|string|max:60',
             'dni' => 'required|max:15',
             'birthdate' => 'required|date',
             'address' => 'required|string|max:150',
             'foto' => 'required|string',             
         ];
         $validator = Validator::make($request->input(),$rules);
         if($validator->fails()){
             return response()->json([
             'status' => false,
             'errors' => $validator->errors()->all()
             ],400);
         }

         $rest = $request->last_name[0];
         $res = "$request->name{$rest}@test.com";
         $email = strtolower($res);

         $user = User::create([
            'name' => $request->name,
            'last_name'=>$request->last_name,
            'email' => $email,
            'password' => $request->dni
        ]);

        
        $id = User::where('users.email',$email)->first();

         $worker = new Worker([
            'name' => $request->name,
            'last_name'=>$request->last_name,
            'dni' => $request->dni,
            'birthdate' => $request->birthdate,
            'address'=> $request->address,
            'foto'=> $request->foto,
            'user_id' => $id->id
        ]);

         $worker -> save();
         return response()->json([
             'status' => true,
             'message' => 'Trabajador creado satisfactoriamente'
             ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        return response()->json(['status' => true, 'data' => $worker]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worker $worker)
    {
        $rules = [
            'name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'dni' => 'required|max:15',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:150',
            'foto' => 'required|string',
        ];
        $validator = Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
            'status' => false,
            'errors' => $validator->errors()->all()
            ],400);
        }
        $worker->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Trabajador actualizado satisfactoriamente'
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return response()->json([
            'status' => true,
            'message' => 'Trabajador eliminado'
            ],200);
    }
}
