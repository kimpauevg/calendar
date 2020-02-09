<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddTablesForRoutines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        Schema::create('RoutineNames',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->unsignedBigInteger('times_used')->default(1);
        });
        Schema::create('UserRoutines',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('routine_ids');
            $table->string('routines_time');
            $table->date('routines_date');
        });
        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::beginTransaction();
        Schema::drop('RoutineNames');
        Schema::drop('UserRoutines');
        DB::commit();
    }
}
