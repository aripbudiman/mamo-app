<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER update_outstanding_trigger_delete AFTER DELETE ON monitoring
            FOR EACH ROW
            BEGIN
                UPDATE anggota
                SET outstanding = outstanding + OLD.nominal
                WHERE id_anggota = OLD.anggota_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_outstanding_trigger_delete;');
    }
};
