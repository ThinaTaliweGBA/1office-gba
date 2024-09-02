:root,
[data-bs-theme=owntheme] {

--bs-aside-bg-color: {{ $styles->body_color }};
--bs-page-bg: {{ $styles->body_bg }};

--bs-body-color: {{ $styles->body_color }};
--bs-body-color-rgb: {{ $styles->body_color_rgb }};
--bs-body-bg: {{ $styles->body_bg }};
--bs-body-bg-rgb: {{ $styles->body_bg_rgb }};

--bs-header-desktop-fixed-bg-color: {{ $styles->header_desktop_fixed_bg_color }};
--bs-header-desktop-fixed-shadow: {{ $styles->header_desktop_fixed_shadow }};
--bs-header-desktop-bottom: {{ $styles->aside_bg_color }};
--bs-header-tablet-and-mobile: {{ $styles->header_tablet_and_mobile }};
--bs-header-tablet-and-mobile-shadow: {{ $styles->header_tablet_and_mobile_shadow }};

--bs-aside-scrollbar-hover-color: {{ $styles->aside_scrollbar_hover_color }};

--bs-app-blank-bg: {{ $styles->app_blank_bg }};
--bs-menu-dropdown-bg-color: {{ $styles->page_bg }};

--bs-button-color: {{ $styles->button_color }};
--text-color: {{ $styles->text_color }};
--div-border-color: {{ $styles->div_border_color }};
--paragraph-font-size: {{ $styles->font_size }};
--paragraph-font-weight: {{ $styles->font_weight }};
--paragraph-font-family: "{{ $styles->font_family }}";
--bs-button-border-radius: {{ $styles->border_radius }};
--paragraph-margin: {{ $styles->paragraph_margin }};
--div-margin: {{ $styles->div_margin }};
--div-padding: {{ $styles->div_padding }};

--bs-menu-dropdown-bg-color: var(--bs-page-bg);

--bs-emphasis-color: #F9F9F9;
--bs-emphasis-color-rgb: 249, 249, 249;
--bs-secondary-color: rgba(255, 255, 255, 0.75);
--bs-secondary-color-rgb: 255, 255, 255;
--bs-secondary-bg: #3F4254;
--bs-secondary-bg-rgb: 63, 66, 84;
--bs-tertiary-color: rgba(255, 255, 255, 0.5);
--bs-tertiary-color-rgb: 255, 255, 255;
--bs-tertiary-bg: #2c2f43;
--bs-tertiary-bg-rgb: 44, 47, 67;
--bs-emphasis-color: #ffffff;
--bs-primary-text: #6ea8fe;
--bs-secondary-text: #E1E3EA;
--bs-success-text: #75b798;
--bs-info-text: #6edff6;
--bs-warning-text: #ffda6a;
--bs-danger-text: #ea868f;
--bs-light-text: #F9F9F9;
--bs-dark-text: #E1E3EA;
--bs-primary-bg-subtle: #031633;
--bs-secondary-bg-subtle: #181C32;
--bs-success-bg-subtle: #051b11;
--bs-info-bg-subtle: #032830;
--bs-warning-bg-subtle: #332701;
--bs-danger-bg-subtle: #2c0b0e;
--bs-light-bg-subtle: #3F4254;
--bs-dark-bg-subtle: #20212a;
--bs-primary-border-subtle: #084298;
--bs-secondary-border-subtle: #5E6278;
--bs-success-border-subtle: #0f5132;
--bs-info-border-subtle: #055160;
--bs-warning-border-subtle: #664d03;
--bs-danger-border-subtle: #842029;
--bs-light-border-subtle: #5E6278;
--bs-dark-border-subtle: #3F4254;
--bs-heading-color: #FFFFFF;
--bs-link-color: #009ef7;
--bs-link-hover-color: #9ec5fe;
--bs-link-color-rgb: 0, 158, 247;
--bs-link-hover-color-rgb: 158, 197, 254;
--bs-code-color: #b93993;
--bs-border-color: #323271;
--bs-border-color-translucent: rgba(255, 255, 255, 0.15);

html[data-bs-theme="owntheme"], body[data-bs-theme="owntheme"] {
color: {{ $styles->body_color }} !important;
background-color: {{ $styles->body_bg }};
font-size: {{ $styles->font_size }} !important;
font-weight: {{ $styles->font_weight }} !important;
font-family: {{ $styles->font_family }} !important;
}

header {
background-color: {{ $styles->header_desktop_fixed_bg_color }} !important;
box-shadow: 0px 1px 5px {{ $styles->header_desktop_fixed_shadow }} !important;
}

header.tablet, header.mobile {
background-color: {{ $styles->header_tablet_and_mobile }} !important;
box-shadow: 0px 1px 5px {{ $styles->header_tablet_and_mobile_shadow }} !important;
}

aside[data-bs-theme="owntheme"] {
background-color: {{ $styles->aside_bg_color }} !important;
}

.page-bg[data-bs-theme="owntheme"] {
background-color: {{ $styles->page_bg }};
}

.app-blank {
background-color: {{ $styles->app_blank_bg }} !important;
}

button {
background-color: {{ $styles->button_color }} !important;
}

.text {
color: {{ $styles->text_color }} !important;
}

div {
border-color: {{ $styles->div_border_color }} !important;
border-radius: {{ $styles->border_radius }} !important;
margin: {{ $styles->div_margin }} !important;
padding: {{ $styles->div_padding }} !important;
}

p {
margin: {{ $styles->paragraph_margin }} !important;
}

}
