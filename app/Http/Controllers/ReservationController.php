<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Reservation;
use App\Models\ReservedCottage;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CreateReservationRequest $request)
    {
        $data = $request->validated();

        $reservedCottage = [];

        $reserved = Reservation::create([
            'name'          =>  $data['name'],
            'contact'       =>  $data['contact'],
            'status'        =>  $data['status'],
            'payment'       =>  $data['payment'],
            'date_booked'   =>  $data['date_booked']
        ]);

        foreach($data['rc'] as $rc){
            $rc['reservation_id'] = $reserved->id;
            $reservedCottage[] = ReservedCottage::create($rc);
        }

        return response()->json([
            'message'   =>  'Reservation Added!',
            'data'      =>  $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
