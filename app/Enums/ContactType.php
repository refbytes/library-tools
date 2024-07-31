<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ContactType: string implements HasLabel
{
    case SALES = 'sales';
    case SUPPORT = 'support';

    public function getLabel(): ?string
    {
        return str($this->value)->title();
    }
}
