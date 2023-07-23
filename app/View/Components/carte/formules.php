<?php

namespace App\View\Components\carte;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Formule;

class formules extends Component
{
    public $formules;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->formules = Formule::where('status', 1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.carte.formules');
    }
}
