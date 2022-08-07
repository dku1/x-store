<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Filter extends Component
{

    public Collection $options;
    public int $total;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $total, Collection $options)
    {
        $this->total = $total;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter');
    }
}
