<?php

namespace App\View\Components;

use App\Models\Jour;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Horaire extends Component
{
    public $horaires;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->horaires = Jour::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.horaire');
    }
}
