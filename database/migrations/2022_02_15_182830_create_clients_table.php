<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('court_id');
            $table->string('client_id');
            $table->string('case_type');
            $table->string('case_number');
            $table->string('case_year', 4);
            $table->string('petitioner');
            $table->string('respondent');
            $table->string('case_date_entry');
            $table->string('file_no');
            $table->integer('payment');
            $table->integer('dues');
            $table->string('comments');
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
        Schema::dropIfExists('clients');
    }
}
