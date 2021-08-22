<?php

namespace App\View\Components\UI;

use Illuminate\View\Component;

class FloatingButton extends Component
{
    public String $href;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $href)
    {
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.u-i.floating-button');
    }
}
