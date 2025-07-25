<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog', function (Blueprint $table) {
             $table->id(); // id column as primary key with auto increment
            $table->text('title');
            $table->text('title_url')->nullable();
            $table->string('meta_title', 5000);
            $table->text('meta_desc');
            $table->text('description');
            $table->text('body');
            $table->string('img_url', 255);
            $table->string('post_code', 10)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('auth_name', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
