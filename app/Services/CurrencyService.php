<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function store(array $data)
    {
        $data['rate'] = $this->getRateByCode($data['code']);
        Currency::create($data);
    }

    public function updateAllRates()
    {
        foreach (Currency::all() as $currency) {
            if (!$currency->isMain()) {
                $currency->update(['rate' => $this->getRateByCode($currency->code)]);
            }
        }
    }

    private function getRateByCode(string $code)
    {
        return $this->getRates()[$code];
    }

    private function getRates()
    {
        return Http::get('https://www.cbr-xml-daily.ru/latest.js')['rates'];
    }

    public function convert($value): float|int
    {
        $currency = Currency::current()->first();
        return $value / $currency->rate;
    }
}
