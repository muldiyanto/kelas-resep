<?php

use App\Models\Team;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Team::class)->index();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};



// $table->foreign('province_id')
//                 ->references('id')
//                 ->on('provinces')
//                 ->onUpdate('cascade')->onDelete('restrict');
// $table->foreign('province_id')
//     ->references('id')
//     ->on('regencies')
//     ->onUpdate('cascade')->onDelete('restrict');
