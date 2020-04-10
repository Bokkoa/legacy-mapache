<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $modules = \App\Module::all();
        return view('adminmodules', ['modules' => $modules]);
    }

    public function modules()
    {   $modules = \App\Module::all();
        return view('modules', ['modules' => $modules]);
    }

    public function moduleswithk(Request $request)
    {   $modules = \App\Module::all();
        return view('modules', ['modules' => $modules, 'k' => $request['key'] ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        var_dump($request->all());
        $module = new \App\Module;
        $module->Module_Name = $request['name'];
        $module->Coordinates = $request['coordinates'];
        $module->Directions = $request['directions'];
        $module->Image_Path = $request['image'];
        $module->created_at = date('Y-m-d h:m:s');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $module = \App\Module::find($request['name']);
        $module->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
                $module = \App\Module::find($request['name']);
                $module->delete();
                alert()->success("Módulo eliminado");
                return redirect('adminmodules');
            }
        catch(\Illuminate\Database\QueryException $e )
            {
                alert()->error("El modulo está vinculado a alguna materia");
                return redirect('adminmodules');
            }
    }
}
