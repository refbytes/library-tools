<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Parental\HasChildren;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Wildside\Userstamps\Userstamps;

class Subscription extends Model implements HasMedia
{
    use HasChildren;
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;
    use Searchable;
    use SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    protected $childTypes = [
        'database' => Database::class,
        'software' => Software::class,
    ];

    public function proxy(): BelongsTo
    {
        return $this->belongsTo(Proxy::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    public function formats(): BelongsToMany
    {
        return $this->belongsToMany(Format::class);
    }

    public function authentications()
    {
        return $this->morphMany(Authentication::class, 'authenticatable');
    }

    protected function fullUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return match ($this?->proxy->enabled) {
                    true => $this->proxy->prefix.$attributes['url'],
                    false => $attributes['url'],
                    null => $attributes['url'],
                };
            },
        );
    }

    public function searchableAs(): string
    {
        return 'subscription_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'vendor' => $this->vendor->name,
            'description' => $this->description,
            'url' => $this->full_url,
            'keywords' => $this->tags->pluck('name')->toArray(),
            'created_at' => $this->created_at->timestamp,
        ];
    }
}
