<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('custom_styles', function (Blueprint $table) {
            $table->id();
            $table->string('body_color');
            $table->string('button_color');
            $table->string('text_color');
            $table->string('border_color');
            $table->string('font_size');
            $table->string('font_weight');
            $table->string('font_family');
            $table->string('border_radius');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_styles');
    }
};
