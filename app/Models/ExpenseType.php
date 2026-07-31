<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ExpenseType extends Model
{
    use HasFactory;
    use SoftDeletes;

    Protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    //slug con evento
    //disparador de evento al crear y editar para el slug
    /*protected static function booted(): void
    {
        parent::booted();

        static::creating(function ($model){
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }*/

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
}
