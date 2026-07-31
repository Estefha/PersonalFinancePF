<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\ExpenseType;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;

        protected $fillable = [
        'expense_type_id',
        'user_id',
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


    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
