<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parental\HasChildren;
use Wildside\Userstamps\Userstamps;

class Subscription extends Model
{
    use HasChildren;
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    protected $childTypes = [
        'database' => Database::class,
        'software' => Software::class,
    ];
}
