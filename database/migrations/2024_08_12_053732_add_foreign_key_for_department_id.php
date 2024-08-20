<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyForDepartmentId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('teachers', function (Blueprint $table) {
        //     $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::create('teachers', function (Blueprint $table) {
        //     $table->dropForeign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
        //     $table->dropForeign('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
        // });
    }
}
