<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View as ContractView;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class DeleteDialog extends Component
{
    public function __construct(
        public string $title,
        public string $message,
        public string $route,
    )
    {
    }

    public function render(): ContractView
    {
        return View::make('components.delete-dialog');
    }
}
