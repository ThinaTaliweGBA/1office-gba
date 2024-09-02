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
        Schema::create('user_custom_styles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('body_color');
            $table->string('body_color_rgb');
            $table->string('body_bg');
            $table->string('body_bg_rgb');
            $table->string('header_desktop_fixed_bg_color');
            $table->string('header_desktop_fixed_shadow');
            $table->string('header_tablet_and_mobile');
            $table->string('header_tablet_and_mobile_shadow');
            $table->string('aside_bg_color');
            $table->string('aside_scrollbar_hover_color');
            $table->string('page_bg');
            $table->string('app_blank_bg');
            $table->string('button_color');
            $table->string('text_color');
            $table->string('div_border_color');
            $table->string('font_size');
            $table->string('font_weight');
            $table->string('font_family');
            $table->string('border_radius');
            $table->string('paragraph_margin');
            $table->string('div_margin');
            $table->string('div_padding');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_custom_styles');
    }
};
