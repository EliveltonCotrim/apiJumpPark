<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchServiceOrdersRequest;
use App\Http\Requests\StoreServiceOrdersRequest;
use App\Models\r;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $plateNumber = $request->input('plate_number');

        // $serviceOrders = ServiceOrder::with('user')->when($plateNumber, function ($query) use ($plateNumber) {
        //     return $query->where("vehiclePlate", "like", "%{$plateNumber}%");
        // })->paginate(5);

        try {

            $serviceOrders = ServiceOrder::join('users', 'service_orders.userId', '=', 'users.id')
                ->select('service_orders.*', 'users.name as userName')
                ->when($plateNumber, function ($query) use ($plateNumber) {
                    return $query->where("vehiclePlate", "like", "%{$plateNumber}%");
                })->paginate(5);

            return response()->json($serviceOrders);
            
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceOrdersRequest $request)
    {
        try {

            $serviceOrder = ServiceOrder::create($request->all());
            return Response()->json($serviceOrder, 201);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
