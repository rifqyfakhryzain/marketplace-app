<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE escrows 
            MODIFY status ENUM(
                'holding',
                'waiting_verification',
                'paid',
                'released',
                'refunded'
            ) NOT NULL DEFAULT 'holding'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE escrows 
            MODIFY status ENUM(
                'holding',
                'released',
                'refunded'
            ) NOT NULL DEFAULT 'holding'
        ");
    }
};
