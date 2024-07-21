<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Format extends Model
{
    use HasFactory, SoftDeletes;
    use Userstamps;
}
