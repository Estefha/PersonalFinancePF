<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ulid',
        'user_id',
        'amount',
        'description',
        'date',
    ];

    protected static function booted(): void
    {
        static::creating(function($income){
            $income->ulid = (string) Str::ulid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
