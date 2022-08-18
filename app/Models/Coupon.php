<?php

namespace App\Models;

use App\Models\Traits\Filter;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory, SoftDeletes, Filter;

    protected $fillable = ['code', 'value', 'currency_id', 'disposable', 'status', 'end_date', 'type'];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'cart_coupon');
    }

    public function scopeCode($query, string $code)
    {
        return $query->where('code', $code);
    }

    public function disposable(): bool
    {
        return $this->disposable === 1;
    }

    public function isPercentage(): bool
    {
        return $this->type === 'percentage';
    }

    public static function codeGenerate(): string
    {
        return Str::random(8);
    }

    public function deactivate()
    {
        $this->status = 1;
        $this->save();
    }

    public function isAvailable(): bool
    {
        return $this->isActive() and !$this->isOverdue();
    }

    public function isActive(): bool
    {
        return $this->status === 0;
    }

    public function isOverdue(): bool
    {
        return Carbon::now() > Carbon::parse($this->end_date);
    }
}
