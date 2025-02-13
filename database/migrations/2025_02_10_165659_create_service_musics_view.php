<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement($this->dropView());
    }

    private function dropView(): string
    {
        return <<<SQL
        DROP VIEW IF EXISTS `vw_service_musics`;
        SQL;
    }

    private function createView(): string
    {
        return <<<SQL
        CREATE OR REPLACE VIEW `vw_service_musics` AS
        SELECT
            sm.id,
            sm.service_id,
            sm.music_id,
            m.name as music,
            m.style_id,
            s.name as style,
            m.genre_id,
            g.name as genre,
            m.interpreter_id,
            i.name as interpreter
        FROM service_musics sm 
        LEFT JOIN musics m ON sm.music_id = m.id 
        LEFT JOIN styles s ON m.style_id = s.id 
        LEFT JOIN genres g on m.genre_id = g.id
        LEFT JOIN interpreters i on m.interpreter_id = i.id 
        SQL;
    }
};
