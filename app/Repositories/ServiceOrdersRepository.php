<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class ServiceOrdersRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllServiceOrders()
    {
        $this->model = $this->model->with('user');
    }

    public function create($data)
    {
        $data = [
            'vehiclePlate' => $data['vehiclePlate'],
            'entryDateTime' => $data['entryDateTime'],
            'exitDateTime' => $data['exitDateTime'] ?? '0001-01-01 00:00:00',
            'priceType' => $data['priceType'],
            'price' => $data['price'] ?? '0.00',
            'userId' => $data['userId'],
        ];

        $serviceOrder = $this->model->create($data);
        $serviceOrder = $this->model->with('user')->find($serviceOrder->id);

        return $serviceOrder;
    }

    public function getFilteredServiceOrders($plateNumber)
    {
        $this->model->when($plateNumber, function ($query) use ($plateNumber) {
            $this->model =  $query->where('vehiclePlate', 'like', '%' . $plateNumber . '%');
        });
    }

    public function paginateServiceOrders()
    {
        return $this->model = $this->model->paginate(5);
    }
}
