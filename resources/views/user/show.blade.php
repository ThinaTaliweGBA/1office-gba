@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header bg-dark text-white d-flex justify-content-between">
                    <h2 class="mb-0" style>User Profile</h3>  
                </div>
                <div class="card-body">
                    <h5 class="text-dark mb-2"><i class="fa fa-user" aria-hidden="true"></i> {{ $user->name }}</h5>
                    <p class="text-secondary"><i class="fa fa-envelope" aria-hidden="true"></i> {{ $user->email }}</p>
                    
                        <div class="custom-style-info">
                        <p class="mx-12"><strong>Styling Preferences</strong></p>
                        <p class="text-secondary"><i class="fa fa-palette" aria-hidden="true"></i> Body Color: {{ isset($customStyles->body_color) ? $customStyles->body_color : 'Default Body Color' }}</p>
                        <p class="text-secondary"><i class="fa fa-fill-drip" aria-hidden="true"></i> Body Background Color: {{ isset($customStyles->body_bg) ? $customStyles->body_bg : 'Default Body Background Color' }}</p>
                        <p class="text-secondary"><i class="fa fa-fill" aria-hidden="true"></i> Button Color: {{ isset($customStyles->button_color) ? $customStyles->button_color : 'Default Button Color' }}</p>
                        <!-- Add the rest -->
                        <p class="text-secondary"><i class="fa fa-palette" aria-hidden="true"></i> Body Color: {{ isset($customStyles->body_color) ? $customStyles->body_color : 'Default' }}</p>
                        <p class="text-secondary"><i class="fa fa-palette" aria-hidden="true"></i> Button Color: {{ isset($customStyles->button_color) ? $customStyles->button_color : 'Default' }}</p>
                        <p class="text-secondary"><i class="fa fa-palette" aria-hidden="true"></i> Text Color: {{ isset($customStyles->text_color) ? $customStyles->text_color : 'Default' }}</p>
                        <p class="text-secondary"><i class="fa fa-palette" aria-hidden="true"></i> Div Border Color: {{ isset($customStyles->div_border_color) ? $customStyles->div_border_color : 'Default' }}</p>
                        <p class="text-secondary">Font Size: {{ isset($customStyles->font_size) ? $customStyles->font_size : 'Default' }}</p>
                        <p class="text-secondary">Font Weight: {{ isset($customStyles->font_weight) ? $customStyles->font_weight : 'Default' }}</p>
                        <p class="text-secondary">Font Family: {{ isset($customStyles->font_family) ? $customStyles->font_family : 'Default' }}</p>
                        <p class="text-secondary">Border Radius: {{ isset($customStyles->border_radius) ? $customStyles->border_radius : 'Default' }}</p>
                        <p class="text-secondary">Paragraph Margin: {{ isset($customStyles->paragraph_margin) ? $customStyles->paragraph_margin : 'Default' }}</p>
                        <p class="text-secondary">Div Margin: {{ isset($customStyles->div_margin) ? $customStyles->div_margin : 'Default' }}</p>
                        <p class="text-secondary">Div Padding: {{ isset($customStyles->div_padding) ? $customStyles->div_padding : 'Default' }}</p>
                        <!-- Add the rest -->
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    :root {
        --bs-body-color: {{ isset($customStyles->body_color) ? $customStyles->body_color : '#000000' }};
        --bs-body-bg: {{ isset($customStyles->body_bg) ? $customStyles->body_bg : '#ffffff' }};
        --bs-button-color: {{ isset($customStyles->button_color) ? $customStyles->button_color : '#000000' }};
        
        /* Add the rest of your styles here */
        /* Example */
        --bs-body-color-rgb: {{ isset($customStyles->body_color_rgb) ? $customStyles->body_color_rgb : 'default_rgb_values' }};
        --bs-body-bg-rgb: {{ isset($customStyles->body_bg_rgb) ? $customStyles->body_bg_rgb : 'default_rgb_values' }};
        --bs-header-desktop-fixed-bg-color: {{ isset($customStyles->header_desktop_fixed_bg_color) ? $customStyles->header_desktop_fixed_bg_color : 'default_color' }};
        --bs-header-desktop-fixed-shadow: {{ isset($customStyles->header_desktop_fixed_shadow) ? $customStyles->header_desktop_fixed_shadow : 'default_value' }};
        --bs-header-tablet-and-mobile: {{ isset($customStyles->header_tablet_and_mobile) ? $customStyles->header_tablet_and_mobile : 'default_value' }};
        --bs-header-tablet-and-mobile-shadow: {{ isset($customStyles->header_tablet_and_mobile_shadow) ? $customStyles->header_tablet_and_mobile_shadow : 'default_value' }};
        --bs-aside-bg-color: {{ isset($customStyles->aside_bg_color) ? $customStyles->aside_bg_color : 'default_color' }};
        --bs-aside-scrollbar-hover-color: {{ isset($customStyles->aside_scrollbar_hover_color) ? $customStyles->aside_scrollbar_hover_color : 'default_color' }};
        --bs-page-bg: {{ isset($customStyles->page_bg) ? $customStyles->page_bg : 'default_color' }};
        --bs-app-blank-bg: {{ isset($customStyles->app_blank_bg) ? $customStyles->app_blank_bg : 'default_color' }};
    
    }

    body {
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
    }
    .custom-style-info{
        border: 3px solid black;
        padding: 6px;
    }
    /* Use the rest of your CSS variables here */
</style>
@endpush
