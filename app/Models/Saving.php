<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Expense;


class Saving extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'savings';
    protected $fillable = [
        'ulid',
        'user_id',
        'expense_id',
        'amount',
        'savings_purpose',
        'description',
        'date',
    ];

    protected static function booted(): void
    {
        static::creating(function($saving){
            $saving->ulid = (string) Str::ulid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /// hasOne:Se utiliza desde el modelo que tiene un registro relacionado. Un ahorro tiene un gasto asociado.
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
