<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->string('avatar')->default("");
            $table->string('color')->default("");
            $table->string('theme')->default("");

            $table->string('address')->default("");
            $table->string('mobile')->default("");
            $table->string('tel')->default("");
            $table->string('country')->default("");
            $table->string('website')->default("");

            $table->string('presenter')->nullable();
            $table->unsignedBigInteger('presenter_id')->nullable();

            $table->unsignedBigInteger('role_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
