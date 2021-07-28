<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('region')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_web')->nullable();
            $table->bigInteger('user_id_auth')->nullable();
            $table->bigInteger('user_id_finance')->nullable();
            $table->bigInteger('user_id_pjb_finance')->nullable();
            $table->string('logo')->nullable();
            $table->string('redaktur')->nullable();
            $table->string('region_sys')->nullable();
            $table->string('code_letter')->default('090');
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
        Schema::dropIfExists('offices');
    }
}
