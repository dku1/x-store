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
        $positions = Position::with('product.category')->filter($filters)->paginate(12);
        $total = $positions->total();
        $options = Option::with('values')->get();
        return view('position.index', compact('positions', 'options', 'total'));
    }

    public function show(Position $position): Factory|View|Application
    {
        $values = Value::whereRelation('positions.product', 'id', '=', $position->product_id)->get();
        $related = Position::with('product.category')
            ->whereRelation('product', 'category_id', '=', $position->product->category_id)
            ->where('id', '!=', $position->id)
            ->get()
            ->take(4);
        return view('position.show', compact('position', 'related', 'values'));
    }

    public function showByValue(PositionFilters $filters, Product $product): RedirectResponse
    {
        $position = Position::where('product_id', $product->id)->filter($filters)->first();
        return redirect()->route('positions.show', $position);
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
