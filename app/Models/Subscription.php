<?php

namespace App\Models;

use App\Jobs\SendMessage;
use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'position_id'];

    protected $with = ['position'];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public static function sendEmails(Position $position)
    {
        $subscriptions = self::activeByProduct($position)->get();
        foreach ($subscriptions as $subscription) {
            SendMessage::dispatch($subscription->email, new SendSubscriptionMessage($position));
            $subscription->status = 0;
            $subscription->save();
        }
    }

    public static function getSubscriptionsByUser()
    {
        return self::where('email', auth()->user()->email)->active()->get();
    }

    public static function subscriptionExists(string $email, Position $position): bool
    {
        $subscription = self::where('email', $email)->where('position_id', $position->id)->activeByProduct($position)->first();
        return (bool)$subscription;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeActiveByProduct($query, Position $position)
    {
        return $query->where('status', 1)->where('position_id', $position->id);
    }
}
