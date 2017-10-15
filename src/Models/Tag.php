<?php

declare(strict_types=1);

namespace Cortex\Tags\Models;

use Rinvex\Tags\Models\Tag as BaseTag;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Cortex\Tags\Models\Tag.
 *
 * @property int                                                                           $id
 * @property string                                                                        $slug
 * @property array                                                                         $name
 * @property array                                                                         $description
 * @property int                                                                           $sort_order
 * @property string                                                                        $group
 * @property \Carbon\Carbon                                                                $created_at
 * @property \Carbon\Carbon                                                                $updated_at
 * @property \Carbon\Carbon                                                                $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cortex\Foundation\Models\Log[] $activity
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag ordered($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Cortex\Tags\Models\Tag withGroup($group = null)
 * @mixin \Eloquent
 */
class Tag extends BaseTag
{
    use LogsActivity;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        'sort_order',
        'group',
        'color',
        'icon',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'slug' => 'string',
        'sort_order' => 'integer',
        'group' => 'string',
        'color' => 'string',
        'icon' => 'string',
        'deleted_at' => 'datetime',
    ];

    /**
     * Indicates whether to log only dirty attributes or all.
     *
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are logged on change.
     *
     * @var array
     */
    protected static $logAttributes = [
        'slug',
        'name',
        'description',
        'sort_order',
        'group',
        'color',
        'icon',
    ];

    /**
     * The attributes that are ignored on change.
     *
     * @var array
     */
    protected static $ignoreChangedAttributes = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('rinvex.tags.tables.tags'));
        $this->setRules([
            'slug' => 'required|alpha_dash|max:150|unique:'.config('rinvex.tags.tables.tags').',slug',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:10000',
            'sort_order' => 'nullable|integer|max:10000000',
            'group' => 'nullable|string|max:150',
            'color' => 'nullable|string|max:7',
            'icon' => 'nullable|string|max:150',
        ]);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
