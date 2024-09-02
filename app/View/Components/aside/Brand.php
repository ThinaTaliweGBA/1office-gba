<?php

namespace App\View\Components\aside;

use Illuminate\View\Component;

class Brand extends Component
{
    public $logoLight;
    public $logoDark;
    public $href;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($logoLight, $logoDark, $href)
    {
        $this->logoLight = $logoLight;
        $this->logoDark = $logoDark;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.aside.brand');
    }
}
