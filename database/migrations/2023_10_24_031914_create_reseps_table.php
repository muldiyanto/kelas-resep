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
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->char('province_id', 2);
            $table->char('regency_id', 4);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('jenis_id');

            $table->foreignIdFor(Team::class)->index();
            $table->string('foto');
            $table->text('bahan');
            $table->text('cara');
            $table->string('catatan');
            $table->timestamps();
        });

        Schema::table('reseps', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                  ->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('jenis_id')->references('id')->on('jenis')
                              ->onDelete('cascade')->onUpdate('cascade');


            $table->foreign('province_id')
                            ->references('id')
                            ->on('provinces')
                            ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('regency_id')
                ->references('id')
                ->on('regencies')
                ->onUpdate('cascade')->onDelete('restrict');

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};
