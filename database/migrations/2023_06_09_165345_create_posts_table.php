<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->string('song_name', 100);
            $table->unsignedInteger('category_id');
            $table->text('summary')->default('');
            $table->text('content')->nullable();
            $table->unsignedInteger('author_id');
            $table->datetime('written_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('image', 200)->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
