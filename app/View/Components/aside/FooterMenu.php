<?php

namespace App\View\Components\aside;

use Illuminate\View\Component;

class FooterMenu extends Component
{
    public $items;
    public $classes;

    /**
     * Create a new component instance.
     *
     * @param $items
     * @param string $classes
     */
    public function __construct($items, $classes = '')
    {
        $this->items = $items;
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.aside.footer-menu');
    }
}
