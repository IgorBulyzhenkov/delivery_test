<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Clients;

class ClientsController extends BaseController
{
    static public function createClients($data): array
    {
        $client_sender = Clients::query()
            ->where([
                'phone' => $data['sender']['phone']
            ])
            ->first();

        if (is_null($client_sender)) {
            $client_sender = Clients::query()
                ->create($data['sender']);
        }

        $client_recipient = Clients::query()
            ->where([
                'phone' => $data['recipient']['phone']
            ])
            ->first();

        if (is_null($client_recipient)) {
            $client_recipient = Clients::query()
                ->create($data['recipient']);
        }

        return [
            'sender_id'    => $client_sender->id,
            'recipient_id' => $client_recipient->id
        ];
    }
}
