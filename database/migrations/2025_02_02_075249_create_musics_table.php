<?php

use App\Models\Music\Genre;
use App\Models\Music\Interpreter;
use App\Models\Music\Style;
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
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Style::class)->constrained();
            $table->foreignIdFor(Genre::class)->constrained();
            $table->foreignIdFor(Interpreter::class)->constrained();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('musics', function (Blueprint $table) {
            $table->dropForeign(['style_id']);
            $table->dropForeign(['genre_id']);
            $table->dropForeign(['interpreter_id']);
        });
        Schema::dropIfExists('musics');
    }
};
