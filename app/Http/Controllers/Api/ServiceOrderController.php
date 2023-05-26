<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreServiceOrdersRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchServiceOrdersRequest;
use App\Http\Resources\ServiceOrdersResource;
use App\Models\ServiceOrder;
use App\Repositories\ServiceOrdersRepository;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    private $serviceOrder;
    private $serviceOrderRepository;

    public function __construct(ServiceOrder $serviceOrder)
    {
        $this->serviceOrder = $serviceOrder;
        $this->serviceOrderRepository = new ServiceOrdersRepository($this->serviceOrder);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchServiceOrdersRequest $request)
    {
        $plateNumber = $request->input('plate_number');

        try {

            $this->serviceOrderRepository->getAllServiceOrders();

            if ($plateNumber) {
                $this->serviceOrderRepository->getFilteredServiceOrders($plateNumber);
            }

            return ServiceOrdersResource::collection($this->serviceOrderRepository->paginateServiceOrders());

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

            $serviceOrder = $this->serviceOrderRepository->create($request->validated());

            return Response()->json($serviceOrder, 201);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
