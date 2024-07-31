<?php

namespace Database\Factories\Subscriptions;

use App\Models\Subscriptions\Format;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FormatFactory extends Factory
{
    protected $model = Format::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
