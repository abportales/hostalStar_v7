<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('room_id');
            $table->foreignId('room_id')->nullable()->constrained('rooms')->nullOnDelete();
            $table->string('renters_name', 100)->nullable();
            $table->string('renters_ine_ocr', 20)->nullable();
            $table->double('money_deposit')->nullable();
            $table->integer('paid_weeks')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('paid')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents');
    }
}
