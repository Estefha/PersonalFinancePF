<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class DebtPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ulid',
        'user_id',
        'debt_id',
        'amount',
        'description',
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

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}
