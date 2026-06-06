<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('realizations')) {
            return;
        }

        Schema::create('realizations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('main_image')->nullable();
            $table->text('slug')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realizations');
    }
};
