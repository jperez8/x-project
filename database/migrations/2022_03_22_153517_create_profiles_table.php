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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('type_profile_id')->constrained();
            $table->text('username')->nullable();
            $table->text('description')->nullable();
            $table->string('profile_mini_image')->nullable();
            $table->string('profile_header_image')->nullable();
            $table->json('fav_styles')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_public')->default(true);
            $table->integer('num_followers')->default(0);
            $table->integer('num_followeds')->default(0);
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
        Schema::dropIfExists('profiles');
    }
};
