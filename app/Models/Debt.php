<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use Hasfactory, SoftDeletes;

    protected $fillable = [
        'ulid',
        'user_id',
        'creditor',
        'amount',
        'description',
        'status',
        'date',
    ];

    protected static function booted(): void
    {
        static::creating(function($model){
            $model->ulid = (string) Str::ulid();
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
