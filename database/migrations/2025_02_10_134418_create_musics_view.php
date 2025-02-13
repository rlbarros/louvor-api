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
        DROP VIEW IF EXISTS `vw_musics`;
        SQL;
    }

    private function createView(): string
    {
        return <<<SQL
        CREATE OR REPLACE VIEW `vw_musics` AS
        SELECT
            m.id,
            m.style_id,
            s.name as style,
            m.genre_id,
            g.name as genre,
            m.interpreter_id,
            i.name as interpreter,
            m.name
        FROM musics m 
        LEFT JOIN styles s ON m.style_id = s.id 
        LEFT JOIN genres g on m.genre_id  = g.id
        LEFT JOIN interpreters i on m.interpreter_id = i.id 
        SQL;
    }
};
