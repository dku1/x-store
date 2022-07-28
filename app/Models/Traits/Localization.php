<?php

namespace App\Models\Traits;

trait Localization
{
    public function getField($fieldName)
    {
        $locale = session('locale', 'ru');
        $field = $fieldName . '_' . $locale;
        return $this->$field;
    }
}
