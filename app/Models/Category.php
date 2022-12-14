<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = empty($value) ?
            Str::slug($this->attributes['name'])
            : str_replace(' ', '-', $value);
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::created(function ($model) {
            $model->slug .= $model->id;
            $model->save();
        });
    }
}
