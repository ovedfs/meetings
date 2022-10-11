<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_changes', function (Blueprint $table) {
            $table->id();
            $table->text('reason');
            $table->integer('old_user_id');
            $table->integer('new_user_id');
            $table->string('role');

            $table->unsignedBigInteger('part_id');
            $table->foreign('part_id')->references('id')->on('parts');

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
        Schema::dropIfExists('part_changes');
    }
}
