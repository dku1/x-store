<?php

namespace App\View\Components;

use App\Models\Currency;
use App\Models\Position;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PositionCard extends Component
{
    public Position $position;

    public Currency $currentCurrency;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Position $position, Currency $currentCurrency)
    {
        $this->position = $position;
        $this->currentCurrency = $currentCurrency;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.position-card');
    }
}
