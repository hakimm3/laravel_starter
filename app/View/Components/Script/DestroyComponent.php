<?php

namespace App\View\Components\Script;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DestroyComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.script.destroy-component');
    }
}
