<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    public function store(array $data)
    {
        $data['end_date'] = $this->getDateTimeFormat($data['end_date']);
        if ($data['type'] == 'percentage') {
            unset($data['currency_id']);
        }
        Coupon::create($data);
    }

    public function update(array $data, Coupon $coupon)
    {
        $data['end_date'] = $this->getDateTimeFormat($data['end_date']);
        if ($data['type'] == 'percentage') {
            unset($data['currency_id']);
        }
        $coupon->update($data);
    }

    public function getDateTimeFormat(string $date): string
    {
        return date("Y-m-d H:i:s", strtotime($date));
    }
}
