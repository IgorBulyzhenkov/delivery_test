<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * |- id_sender
     * |- id_reciever
     * |- w
     * |- h
     * |- d
     * |- status (enum - new, wait-for-delivery, delivery, waiting-for-receiver, received, canceled)
     * |- description
     */
    public function up(): void
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('id_sender')->constrained('clients','id')->cascadeOnDelete();
            $table->foreignId('id_recipient')->constrained('clients','id')->cascadeOnDelete();
            $table->foreignId('id_deliveries')->constrained('deliveries','id')->cascadeOnDelete();
            $table->integer('width');
            $table->integer('height');
            $table->integer('depth');
            $table->enum('status', [
                'new',
                'wait-for-delivery',
                'delivery',
                'waiting-for-receiver',
                'received',
                'canceled'
            ])->default('new');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};
