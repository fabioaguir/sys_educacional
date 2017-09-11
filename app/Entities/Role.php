<?php

namespace SerEducacional\Entities;


use GeniusTS\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use GeniusTS\Roles\Traits\RoleHasRelations;
use GeniusTS\Roles\Contracts\RoleHasRelations as RoleHasRelationsContract;

class Role extends Model implements RoleHasRelationsContract
{

    use Slugable, RoleHasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'level',
        'sistema'
    ];

    /**
     * Create a new model instance.
     *
     * Role constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('roles.connection'))
        {
            $this->connection = $connection;
        }
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeResolvedName($query)
    {
        return $query->where('roles.sistema', 1)->select('name as nome', 'id');
    }
}
