<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCottageRequest;
use App\Http\Requests\UpdateCottageRequest;
use App\Models\Cottage;
use Illuminate\Http\Request;

class CottageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cottage = Cottage::orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'message'   =>  'Cottages list',
            'cottages'  =>  $cottage
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCottageRequest $request)
    {
        $cottage = Cottage::create($request->validated());

        return response()->json([
            'message'   =>  'Cottages added!',
            'cottage'   =>  $cottage
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cottage $cottage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cottage $cottage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCottageRequest $request, $id)
    {
        $cottage = Cottage::find($id);

        $cottage->update($request->validated());

        return response()->json([
            'message'   =>  'Cottage updated!',
            'data'      =>  $cottage->fresh()
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cottage $cottage)
    {
        //
    }
}
