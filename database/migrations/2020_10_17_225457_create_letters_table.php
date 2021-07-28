<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->unsigned()->references('id')->on('users');
            $table->foreignId('user_id_auth')->unsigned();
            $table->foreignId('user_id_finance')->unsigned();
            $table->foreignId('user_id_pjb_finance');
            $table->foreign('user_id_auth')->references('id')->on('users');
            $table->foreign('user_id_finance')->references('id')->on('users');
            $table->foreign('user_id_pjb_finance')->references('id')->on('users');
            $table->bigInteger('num_validate')->nullable();
            $table->string('nomor')->nullable();
            $table->string('transportasi')->nullable();
            $table->string('dasar')->nullable();
            $table->string('acara')->nullable();
            $table->string('cost')->nullable();
            $table->string('from')->nullable();
            $table->string('place_name')->nullable();
            $table->string('to')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('place_issue')->nullable();
            $table->date('date_issue')->nullable();
            $table->text('redaktur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letters');
    }
}
