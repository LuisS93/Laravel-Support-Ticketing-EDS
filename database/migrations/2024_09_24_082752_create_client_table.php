<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string("company_name",100);
            $table->string('address',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('country',2)->nullable();
            $table->string('zip',10)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('email',80)->nullable();
            $table->string('contact_person',100)->nullable();
            $table->string('phone_contact_person',50)->nullable();
            $table->string('email_contact_person',80)->nullable();
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
        Schema::dropIfExists('customer');
    }
}
