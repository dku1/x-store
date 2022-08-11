<?php

namespace App\Models;

use App\Models\Traits\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Value extends Model
{
    use HasFactory, Localization;

    protected $fillable = ['title_ru', 'title_en', 'option_id'];

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class);
    }
}
