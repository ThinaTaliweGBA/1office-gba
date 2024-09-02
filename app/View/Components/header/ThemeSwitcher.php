<?php

namespace App\View\Components\header;

use Illuminate\View\Component;

class ThemeSwitcher extends Component
{
    public $icon;
    public $themes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $themes)
    {
        $this->icon = $icon;
        $this->themes = $themes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.theme-switcher');
    }
}
