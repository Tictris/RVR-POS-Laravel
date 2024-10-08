<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEntranceRequest;
use App\Models\Entrance;
use App\models\BookedCottage;
use App\Models\Cottage;
use App\Models\Customer;
use App\Models\CustomerCount;
use Illuminate\Http\Request;

class EntranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrance = Entrance::with('booked_cottages.cottage', 'customers_count.customer')->orderBy('created_at', 'desc')->paginate(10);
        
        return response()->json([
            'entrance' => $entrance
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(CreateEntranceRequest $request, $id)
    {
        $data = $request->validated();

        $entrance = Entrance::with('booked_cottages', 'customers_count')->find($id);
        $currentTotalVal = $entrance->total;
        $entrance->total = $currentTotalVal + $request->total;
        $entrance->save();     
        
        foreach ($data['bc'] as $bc) {
            $existing_bc = $entrance->booked_cottages->where('cottage_id', $bc['cottage_id'])->first();
            if ($existing_bc) {
                $existing_bc->quantity += $bc['quantity'];
                $u_qty[] = $existing_bc->save();

                $cottage = Cottage::find([$bc['cottage_id']]);
        
                foreach ($cottage as $avail) {
                    $avail->available -= $bc['quantity'];
                    $updateCottage[] = $avail->save();
                }
            } else {
                $bc['entrance_id']  = $entrance->id;
                $cottage = Cottage::find([$bc['cottage_id']]);
        
                foreach ($cottage as $avail) {
                    $avail->available -= $bc['quantity'];
                    $updateCottage[] = $avail->save();
                }
                $u_qty[] = BookedCottage::create($bc);
            }       
        }

        foreach ($data['cc'] as $cc) {
            $existing_cc = $entrance->customers_count->where('customer_id', $cc['customer_id'])->first();
            if ($existing_cc) {
                $existing_cc->count += $cc['count'];
                $u_count[] = $existing_cc->save();
            } else {
                $cc['entrance_id'] = $entrance->id;
                $u_count[] = CustomerCount::create($cc);
            }
        }

        return response()->json([
            'message'   =>  'entry added',
            'data'  =>  $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEntranceRequest $request)
    {
        // Validate data before inserting
        $data = $request->validated();

        // empty arrays for storing array datas for inserting
        $bookedCottage = [];
        $customerCount = [];
        $updateCottage = [];

        // insert data to Entrance table
        $entrance = Entrance::create([
            'name'  =>  $data['name'],
            'total' =>  $data['total']
        ]);

        // insert data to Booked Cottage table
        foreach ($data['bc'] as $bc) {
            $bc['entrance_id']  = $entrance->id;
            $bookedCottage[]    = BookedCottage::create($bc);

            $cottage = Cottage::find([$bc['cottage_id']]);
            
            foreach ($cottage as $avail) {
                $avail->available -= $bc['quantity'];
                $updateCottage[] = $avail->save();
            }
        }

        // insert data to Customer Count table
        foreach ($data['cc'] as $cc) {
          $cc['entrance_id']  = $entrance->id;
            $customerCount[]    = CustomerCount::create($cc);
        }

        return response()->json([
            'message'   =>  'new entry added!',
            'data'  => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrance $entrance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $entrance = Entrance::find($id)->with('booked_cottages.cottage', 'customers_count.customer')->get();

        return response()->json([
            'selected'  => $entrance
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrance $entrance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrance $entrance)
    {
        //
    }
}
