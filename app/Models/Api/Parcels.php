<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcels extends Model
{
    use HasFactory;

    protected $table = 'parcels';

    protected $fillable = [
        'uuid',
        'id_sender',
        'id_recipient',
        'id_deliveries',
        'width',
        'height',
        'depth',
        'status',
        'description',
    ];
}
