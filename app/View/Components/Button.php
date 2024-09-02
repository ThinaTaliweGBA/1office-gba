<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $class;
    public $id;
    public $text;
    protected $defaultClass = 'btn';  // Default class

    /**
     * Create a new component instance.
     */
    public function __construct($type = 'button', $class = '', $id = '', $text)
    {
        $this->type = $type;
        $this->class = $this->defaultClass . ' ' . $class;  // Append any additional classes
        $this->id = $id;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.button');
    }
}
