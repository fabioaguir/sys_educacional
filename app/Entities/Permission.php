<?php

namespace SerEducacional\Entities;


use GeniusTS\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use GeniusTS\Roles\Traits\PermissionHasRelations;
use GeniusTS\Roles\Contracts\PermissionHasRelations as PermissionHasRelationsContract;

class Permission extends Model implements PermissionHasRelationsContract
{

    use Slugable, PermissionHasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'model'
    ];

    /**
     * Create a new model instance.
     * 
     * Permission constructor.
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
    public function resolvedNameScope($query)
    {
        return $query->select('name as nome', 'id');
    }
}
