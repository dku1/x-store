<?php

namespace App\View\Components\Filters;

use Illuminate\View\Component;

class FilterForm extends Component
{

    public string $title;
    public string $buttonText;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $buttonText)
    {
        $this->title = $title;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filters.filter-form');
    }
}
