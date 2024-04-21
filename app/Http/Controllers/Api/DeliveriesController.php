<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Deliveries;

class DeliveriesController extends BaseController
{
    public function getDeliveries(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $deliveries = Deliveries::all();

        return response([
            'deliveries' => $deliveries
        ], 200);
    }

    static public function getOneDelivery($id): bool
    {
        return Deliveries::query()
            ->where([
                'id' => $id
            ])->exists();
    }
}
