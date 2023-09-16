<?php

namespace App\View\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class InputField extends Component
{
    public function __construct(
        public string $label,
        public string $icon = '',
        public string $type = 'text',
        public string $name = '',
        public ?string $error = '',
        public ?string $value = '',
        public bool $required = true,
        public bool $readonly = false,
        public bool $focus = false,
    )
    {
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return View::make('components.input-field');
    }
}
