<?php

namespace App\Models;

use App\Models\Traits\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, Filter;

    protected $fillable = ['first_name', 'last_name', 'address', 'city', 'index', 'user_id', 'coupon_id', 'cart_id', 'currency_id', 'email'];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function isProcessed(): bool
    {
        return $this->status === 1;
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function handle()
    {
        $this->status = 1;
        $this->save();
    }

    public function getSum()
    {
        return $this->cart->getFullPrice($this->currency);
    }
}
