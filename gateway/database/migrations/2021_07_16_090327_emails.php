<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Emails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('emails', function(Blueprint $table) {
            $table->id('eml_id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id','fk_emails_user_id')->references('usr_id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('email')->unique();
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
        Schema::dropIfExists('emails');
    }
}
