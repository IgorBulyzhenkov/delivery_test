<?php

namespace App\Services\Api;

use App\Http\Controllers\Api\ClientsController;
use App\Models\Api\Parcels;
use Illuminate\Support\Str;

class ParcelsService
{
    public function handleCreate($data)
    {
        $dataClients = [
            'sender'    => [
                'name'  => $data['name_sender'],
                'phone' => $data['phone_sender'],
            ],
            'recipient' => [
                'name'  => $data['name_recipient'],
                'phone' => $data['phone_recipient'],
            ]
        ];

        $clients    = ClientsController::createClients($dataClients);
        $uuid       = $this->getUuid();

        $dataParcels = [
            'id_sender'     => $clients['sender_id'],
            'id_recipient'  => $clients['recipient_id'],
            'id_deliveries' => $data['id_deliveries'],
            'uuid'          => $uuid,
            'width'         => $data['width'],
            'height'        => $data['height'],
            'depth'         => $data['depth'],
            'description'   => $data['description']
        ];

        $parcel = Parcels::create($dataParcels);

        return [
            'uuid'      => $uuid,
            'parcel'    => $parcel
        ];
    }

    private function getUuid(): string
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
