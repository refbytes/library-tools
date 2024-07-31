<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AuthenticationType: string implements HasLabel
{
    case ADMIN = 'admin';
    case REPORTING = 'reporting';
    case SUPPORT = 'support';

    public function getLabel(): ?string
    {
        return str($this->value)->title();
    }
}
