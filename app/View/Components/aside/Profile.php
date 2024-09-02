<?php

namespace App\View\Components\aside;

use Illuminate\View\Component;

class Profile extends Component
{
    public $name;
    public $profileLink;
    public $profileImg;
    public $description;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $profileLink, $profileImg, $description)
    {
        $this->name = $name;
        $this->profileLink = $profileLink;
        $this->profileImg = $profileImg;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.aside.profile');
    }
}
