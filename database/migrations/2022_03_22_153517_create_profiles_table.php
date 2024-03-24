<?php

use App\Models\User;
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
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('type_profile')->nullable();
            $table->text('username')->nullable();
            $table->text('description')->nullable();
            $table->string('profile_mini_image')->nullable();
            $table->string('profile_header_image')->nullable();
            $table->json('fav_styles')->nullable();
            $table->json('fav_brands')->nullable();
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
