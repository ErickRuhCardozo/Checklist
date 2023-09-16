<?php

namespace App\View\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class App extends Component
{
    public function __construct(
        public string $title,
        public string $back = '',
        public ?object $leftHeaderSection = null,
        public ?object $rightHeaderSection = null,
        public ?object $rightBodySection = null
    )
    {
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return View::make('components.app');
    }
}
