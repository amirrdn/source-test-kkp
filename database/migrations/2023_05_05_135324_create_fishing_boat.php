<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishing_boat', function (Blueprint $table) {
            $table->id();
            $table->string('boat_code');
            $table->string('boat_name')->nullable();
            $table->text('address')->nullable();
            $table->string('size_boat')->nullable();
            $table->string('captain')->nullable();
            $table->integer('member_count')->nullable();
            $table->string('images')->nullable();
            $table->string('license_number')->nullable();
            $table->enum('status',[0, 1])->default(0);
            $table->text('reasson')->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('fishing_boat');
    }
};
