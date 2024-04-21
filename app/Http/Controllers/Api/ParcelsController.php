<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ParcelsRequest;
use App\Models\Api\Parcels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ParcelsController extends BaseController
{
    public function addParcels(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $parReq     = new ParcelsRequest();

        $validator  = Validator::make(
            $request->all(),
            $parReq->rules()
        );

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'error'     => $validator->messages()
            ],400);
        }

        if(!DeliveriesController::getOneDelivery($request->id_deliveries)){
            return response([
                'status'    => false,
                'error'     => 'not found deliveries'
            ], 404);
        }

        $data = [
            'sender' => [
                'name'  => $request->name_sender,
                'phone' => $request->phone_sender
            ],
            'recipient' => [
                'name'  => $request->name_recipient,
                'phone' => $request->phone_recipient
            ]
        ];

        $clients    = ClientsController::createClients($data);

        $uuid       = $this->getUuid();

        $dataParcels = [
            'id_sender'     => $clients['sender_id'],
            'id_recipient'  => $clients['recipient_id'],
            'id_deliveries' => $request->id_deliveries,
            'uuid'          => $uuid,
            'width'         => $request->width,
            'height'        => $request->height,
            'depth'         => $request->depth,
            'description'   => $request->description
        ];

        $parcels = Parcels::query()
            ->create($dataParcels);

        return response([
            'status'    => true,
            'uuid'      => $uuid,
            'message'   => 'parcels created'
        ], 201);
    }

    private function getUuid()
    {
        do {
            $uuid   = Str::uuid()->toString();
            $exists = Parcels::query()
                ->where([
                    'uuid' => $uuid
                ])
                ->exists();
        } while ($exists);

        return $uuid;
    }

}
