<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
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
        $reservation = Reservation::with('reserved_cottages.cottage')->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'message'       =>  'list of reservations',
            'reservation'   =>  $reservation
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
    public function store(CreateReservationRequest $request)
    {
        $data = $request->validated();

        $reservedCottage = [];

        $reserved = Reservation::create([
            'name'          =>  $data['name'],
            'contact'       =>  $data['contact'],
            'status'        =>  $data['status'],
            'payment'       =>  $data['payment'],
            'date_booked'   =>  $data['date_booked'],
            'remarks'       =>  $data['remarks']
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
    public function update(UpdateReservationRequest $request, $id)
    {

        $data = $request->validated();

        $reservation = Reservation::with('reserved_cottages')->find($id);

        $reservation->update([
            'name'          =>  $data['name'],
            'contact'       =>  $data['contact'],
            'status'        =>  $data['status'],
            'payment'       =>  $data['payment'],
            'date_booked'   =>  $data['date_booked']
        ]);

        foreach ($data['rc'] as $rc) {
            if ($rc['quantity'] > 0) {
                $reservedCottage = ReservedCottage::where('reservation_id', $reservation->id)->where('cottage_id', $rc['cottage_id'])->first();
                if ($reservedCottage) {
                    $reservedCottage->update($rc);
                } else {
                    ReservedCottage::create($rc);
                }
            } else {
                ReservedCottage::where('reservation_id', $reservation->id)->where('cottage_id', $rc['cottage_id'])->delete();
            }
        }

        return response()->json([
            'message'   =>  'Reservation Updated!',
            'data'      =>  $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
