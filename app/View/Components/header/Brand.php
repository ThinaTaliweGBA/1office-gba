<?php

namespace App\View\Components\header;

use Illuminate\View\Component;

class Brand extends Component
{
    public $class;
    public $href;
    public $logoSrc;
    public $logoAlt;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class, $href, $logoSrc, $logoAlt)
    {
        $this->class = $class;
        $this->href = $href;
        $this->logoSrc = $logoSrc;
        $this->logoAlt = $logoAlt;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.brand');
    }
}
