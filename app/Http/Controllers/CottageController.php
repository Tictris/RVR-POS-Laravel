<?php

namespace App\Http\Controllers;

use App\Http\Requests\CottageRequest;
use App\Http\Requests\CreateCottageRequest;
use App\Http\Requests\UpdateCottageRequest;
use Illuminate\Http\Request;
use App\Models\Cottage;

class CottageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cottage = Cottage::orderBy('created_at')->get();
        
        return response()->json([
            'message'   =>  'List of all cottages',
            'data'      =>  $cottage
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CottageRequest $request)
    {
        $cottage = Cottage::create($request->validated());

        return response()->json([
            'message'   => 'New Cottage Added',
            'cottage'   =>  $cottage->fresh()
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CottageRequest $request, $id)
    {

        $cottage = Cottage::findOrFail($id);

        $cottage->update($request->validated());


        return response()->json([
            'message'   =>  'Cottage details updated',
            'cottage'   =>  $cottage
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
