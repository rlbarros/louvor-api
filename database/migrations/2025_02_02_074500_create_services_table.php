<?php

use App\Models\Ministry;
use App\Models\Service\ServiceType;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ministry::class)->constrained();
            $table->date('day');
            $table->foreignIdFor(ServiceType::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['ministry_id']);
            $table->dropForeign(['service_type_id']);
        });
        Schema::dropIfExists('services');
    }
};
