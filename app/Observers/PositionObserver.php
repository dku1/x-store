<?php

namespace App\Observers;

use App\Models\Position;
use App\Models\Product;
use App\Models\Subscription;

class PositionObserver
{
    public function updating(Position $position)
    {
        $oldCount = $position->getOriginal('count');
        if ($oldCount === 0 and $position->count > 0){
            Subscription::sendEmails($position);
        }
    }
}
