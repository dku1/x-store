<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'value', 'currency_id', 'disposable', 'status', 'end_date'];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public static function codeGenerate(): string
    {
        return Str::random(8);
    }
}
