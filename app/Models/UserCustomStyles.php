<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomStyles extends Model
{
    use HasFactory;

    protected $table = 'user_custom_styles';

    protected $fillable = [
        'body_color',
        'button_color',
        'text_color',
        'div_border_color',
        'font_size',
        'font_weight',
        'font_family',
        'border_radius',
        'paragraph_margin',
        'div_margin',
        'div_padding',
        'body_color_rgb',
        'body_bg',
        'body_bg_rgb',
        'header_desktop_fixed_bg_color',
        'header_desktop_fixed_shadow',
        'header_tablet_and_mobile',
        'header_tablet_and_mobile_shadow',
        'aside_bg_color',
        'aside_scrollbar_hover_color',
        'page_bg',
        'app_blank_bg',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
