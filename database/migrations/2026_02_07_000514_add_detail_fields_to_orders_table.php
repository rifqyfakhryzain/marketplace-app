<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::table('orders', function (Blueprint $table) {
    $table->foreignId('barang_id')
        ->after('seller_id')
        ->constrained('barang') // 🔥 FIX DI SINI
        ->cascadeOnDelete();

    $table->integer('qty')->default(1)->after('barang_id');
    $table->string('receiver_name')->after('status');
    $table->string('phone')->after('receiver_name');
    $table->text('address')->after('phone');
    $table->text('note')->nullable()->after('address');
});

    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'barang_id',
                'qty',
                'receiver_name',
                'phone',
                'address',
                'note',
            ]);
        });
    }
};
