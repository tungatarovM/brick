<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('avatar');
            $table->string('position', 120);
            $table->enum('status', ['active', 'archive'])->default('active');
            $table->json('shift')
                ->default('{ "shift_start": "09:00", "shift_end": "18:00" }'); // TODO replace with constant
            $table->json('breaks')
                ->default('{ "breaks": ["13:00-14:00"] }'); // TODO replace with constant
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
