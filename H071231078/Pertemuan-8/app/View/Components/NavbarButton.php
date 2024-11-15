<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavbarButton extends Component
{
    public $label;
    public $url;

    public function __construct($label, $url)
    {
        $this->label = $label;
        $this->url = $url;
    }

    public function render()
    {
        return view('components.navbar-button');
    }
}
