<?php

namespace App\Models;

use App\Models\Traits\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes, Filter;

    protected $fillable = ['code', 'symbol', 'is_main', 'rate'];

    public function scopeCurrent($query)
    {
        return $query->where('code', session('currency', 'RUB'));
    }

    public function isMain(): bool
    {
        return $this->is_main == 1;
    }

    public function convert(float|int $value): float|int
    {
        return $value * $this->rate;
    }
}
