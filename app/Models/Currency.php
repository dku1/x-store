<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'symbol', 'is_main', 'rate'];

    public static function getCurrent()
    {
        return self::where('code', session('currency', 'RUB'))->first();
    }

    public function isMain(): bool
    {
        return $this->is_main == 1;
    }
}
