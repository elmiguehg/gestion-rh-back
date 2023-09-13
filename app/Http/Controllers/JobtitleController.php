<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Jobtitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JobtitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobtitles = Jobtitle::select('jobtitles.*','categories.name as category')
        ->join('categories','categories.id','=','jobtitles.category_id')->get();
        return response()->json($jobtitles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:60',
            'importance' => 'required|numeric|min:1|max:10',
            'is_boss' => 'required',
            'category_id' => 'required|numeric'
        ];
        $validator = Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
            'status' => false,
            'errors' => $validator->errors()->all()
            ],400);
        }
        $jobtitle = new Jobtitle($request->input());
        $jobtitle -> save();
        return response()->json([
            'status' => true,
            'message' => 'Puesto de trabajo creado satisfactoriamente'
            ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jobtitle $jobtitle)
    {
        return response()->json(['status' => true, 'data' => $jobtitle]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jobtitle $jobtitle)
    {
        $rules = [
            'name' => 'required|max:60',
            'importance' => 'required|numeric|min:1|max:10',
            'is_boss' => 'required',
            'category_id' => 'required|numeric'
        ];
        $validator = Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
            'status' => false,
            'errors' => $validator->errors()->all()
            ],400);
        }
        $jobtitle->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Puesto de trabajo actualizado satisfactoriamente'
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobtitle $jobtitle)
    {
        $jobtitle->delete();
        return response()->json([
            'status' => true,
            'message' => 'Puesto de trabajo eliminado'
            ],200);
    }
}
