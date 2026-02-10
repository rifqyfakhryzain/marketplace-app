<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE escrows 
            MODIFY status ENUM(
                'waiting_verification',
                'holding',
                'ready',
                'released'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE escrows 
            MODIFY status ENUM(
                'waiting_verification',
                'holding',
                'released'
            ) NOT NULL
        ");
    }
};
