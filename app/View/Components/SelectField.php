<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class SelectField extends Component
{
    public function __construct(
        public string $label,
        public array $options,
        public string $selectedLabel = '',
        public ?string $selectedValue = '',
        public string $icon = '',
        public string $name = '',
        public string $placeholder = '',
        public bool $required = true,
    )
    {
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return View::make('components.select-field');
    }
}
