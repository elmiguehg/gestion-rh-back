<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Worker;
use App\Models\Jobtitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entity = Entity::all();
        return response()->json($entity);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:60',
        ];
        $validator = Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
            'status' => false,
            'errors' => $validator->errors()->all()
            ],400);
        }

        $DesdeLetra = "a";
        $HastaLetra = "z";
        $DesdeNumero = 1000000000;
        $HastaNumero = 9999999999;
        $letraAleatoria = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
        $numeroAleatorio = rand($DesdeNumero, $HastaNumero);
        $letraAleatoria = ucfirst($letraAleatoria);
        $resul = "$letraAleatoria$numeroAleatorio";


        $entity = new Entity([
               'name' => $request->name,
               'identifier' => $resul
        ]);
        $entity -> save();
        return response()->json([
            'status' => true,
            'message' => 'Entidad creada satisfactoriamente'
            ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entity $entity)
    {
        return response()->json(['status' => true, 'data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entity $entity)
    {
        $rules = [
            'name' => 'required|max:60',
        ];
        $validator = Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
            'status' => false,
            'errors' => $validator->errors()->all()
            ],400);
        }
        $entity->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Entidad actualizada satisfactoriamente'
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entity $entity)
    {
        $entity->delete();
        return response()->json([
            'status' => true,
            'message' => 'Entidad eliminada'
            ],200);
    }

    public function WorkerByEntity($id)
    {
        $entity = Entity::find($id);
        $data = $entity -> worker() -> get();
        return response()->json($data);
    }

    public function JobtitleByEntity($id)
    {
        $entity = Entity::find($id);
        $data = $entity -> jobtitle() -> get();
        return response()->json($data);
    }
}
