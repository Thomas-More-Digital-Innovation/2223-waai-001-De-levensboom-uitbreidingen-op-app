<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Contactgegevens extends Component
{
    public $contactgegevens;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($contactgegevens=null)
    {
        $this->contactgegevens = $contactgegevens;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.contactgegevens');
    }
}
