<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SubscriptionType: string implements HasLabel
{
    case DATABASE = 'database';
    case SOFTWARE = 'software';

    public function getLabel(): ?string
    {
        return str($this->value)->title();
    }
}
