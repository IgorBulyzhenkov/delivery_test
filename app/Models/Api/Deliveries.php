<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    protected $fillable = [
        'name'
    ];
}
