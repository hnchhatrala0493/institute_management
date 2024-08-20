<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyIntoStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('students', function (Blueprint $table) {
        //     $table->foreign('department_id')->references('id')->on('departments');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::create('students', function (Blueprint $table) {
        //     $table->dropForeign('department_id')->references('id')->on('departments');
        // });
    }
}
