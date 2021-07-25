<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Phone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('phones', function(Blueprint $table) {
            $table->id('eml_id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id','fk_phones_user_id')->references('usr_id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('phone')->unique();
            $table->boolean('primary')->default(false);
            $table->boolean('verified')->default(false);
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
        Schema::dropIfExists('phones');
    }
}
