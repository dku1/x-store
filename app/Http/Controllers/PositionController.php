<?php

namespace App\Http\Controllers;

use App\Filters\PositionFilters;
use App\Models\Option;
use App\Models\Position;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\Value;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(PositionFilters $filters): Factory|View|Application
    {
        $positions = Position::filter($filters)->paginate(12);
        $total = $positions->total();
        $options = Option::with('values')->get();
        return view('position.index', compact('positions', 'options', 'total'));
    }

    public function show(Position $position): Factory|View|Application
    {
        $values = Value::whereRelation('positions.product', 'id', '=', $position->product_id)->get();
        $related = Position::byCategory($position->product->category)
            ->where('id', '!=', $position->id)
            ->get()->take(4);
        return view('position.show', compact('position', 'related', 'values'));
    }

    public function showByValue(Product $product, Value $value): RedirectResponse
    {
        $position = Position::byProductValue($product, $value)->first();
        if ($position){
            return redirect()->route('positions.show', $position);
        }
        return redirect()->back()->with('warning', 'Товар не найден');
    }

    public function subscribe(Request $request, Position $position): RedirectResponse
    {
        if (!Subscription::subscriptionExists($request->email, $position)) {
            Subscription::create(['email' => $request->email, 'position_id' => $position->id]);
            return redirect()->back()->with('success',
                'Спасибо, мы сообщим о поступлении ' . $position->product->getField('title'));
        }
        return redirect()->back()->with('warning', 'Вы уже подписаны на этот товар');
    }
}
