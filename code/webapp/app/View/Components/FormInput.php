<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public string $text;
    public string $name;
    public string $type;
    public $value;
    public $disabled;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text, $name, $type = 'text', $value = null, $disabled = "")
    {
        $this->text = $text;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input');
    }
}
