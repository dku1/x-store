<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'product_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function sendEmails(Product $product)
    {
        $subscriptions = self::activeByProduct($product)->get();
        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new SendSubscriptionMessage($product));
            $subscription->status = 0;
            $subscription->save();
        }
    }

    public static function subscriptionExists(string $email, Product $product): bool
    {
        $subscription = self::where('email', $email)->where('product_id', $product->id)->activeByProduct($product)->first();
        return (bool)$subscription;
    }

    public function scopeActiveByProduct($query, Product $product)
    {
        return $query->where('status', 1)->where('product_id', $product->id);
    }
}
