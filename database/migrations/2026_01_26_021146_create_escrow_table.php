<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('escrows', function (Blueprint $table) {
    $table->id();

    $table->foreignId('order_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->integer('amount');

    $table->enum('status', [
        'unverified',   // admin belum cek bukti transfer
        'holding',      // dana ditahan
        'released',     // dana cair ke seller
        'refunded'      // dana kembali ke buyer
    ])->default('unverified');

    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escrows');
    }
};
