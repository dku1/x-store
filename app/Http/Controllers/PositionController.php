<?php

namespace App\Http\Controllers;

use App\Filters\PositionFilters;
use App\Models\Option;
use App\Models\Position;
use App\Models\Product;
use App\Models\Subscription;
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
        $related = Position::byCategory($position->product->category)
            ->where('id', '!=', $position->id)
            ->get()->take(4);
        return view('position.show', compact('position', 'related'));
    }

    public function subscribe(Request $request, Product $product): RedirectResponse
    {
        if (!Subscription::subscriptionExists($request->email, $product)) {
            Subscription::create(['email' => $request->email, 'product_id' => $product->id]);
            return redirect()->back()->with('success',
                'Спасибо, мы сообщим о поступлении ' . $product->getField('title'));
        }
        return redirect()->back()->with('warning', 'Вы уже подписаны на этот товар');
    }
}
