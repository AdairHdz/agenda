<?php

namespace App\View\Components\UI;

use Illuminate\View\Component;

class Delimiter extends Component
{

    public String $title;
    public String $styleClasses;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $title, String $styleClasses = "")
    {
        $this->title = $title;
        $this->styleClasses = $styleClasses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.u-i.delimiter');
    }
}
