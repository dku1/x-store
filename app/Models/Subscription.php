<?php

namespace App\Models;

use App\Jobs\SendMessage;
use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'product_id'];

    protected $with = ['product'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function sendEmails(Product $product)
    {
        $subscriptions = self::activeByProduct($product)->get();
        foreach ($subscriptions as $subscription) {
            SendMessage::dispatch($subscription->email, new SendSubscriptionMessage($product));
            $subscription->status = 0;
            $subscription->save();
        }
    }

    public static function getSubscriptionsByUser()
    {
        return self::where('email', auth()->user()->email)->active()->get();
    }

    public static function subscriptionExists(string $email, Product $product): bool
    {
        $subscription = self::where('email', $email)->where('product_id', $product->id)->activeByProduct($product)->first();
        return (bool)$subscription;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeActiveByProduct($query, Product $product)
    {
        return $query->where('status', 1)->where('product_id', $product->id);
    }
}
