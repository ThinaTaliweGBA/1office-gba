<?php

namespace App\View\Components\aside;

use Illuminate\View\Component;

class AsideMenu extends Component
{
    public $menuTitle;
    public $menuIcon;
    public $menuItems;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menuTitle, $menuIcon, $menuItems)
    {
        $this->menuTitle = $menuTitle;
        $this->menuIcon = $menuIcon;
        $this->menuItems = $menuItems;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.aside.aside-menu');
    }
}
