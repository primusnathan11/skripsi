<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trees', function (Blueprint $table) {
            $table->integer('plant_number')->comment("nomor tumbuhan, diisi ketika pohon dari hasil project b2b")->nullable()->after("code");
            $table->tinyInteger('condition')->comment("0 = dead, 1 = alive")->default(1)->after('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('trees', 'plant_number');
        Schema::dropColumns('trees', 'condition');
    }
};
