@extends('layouts.app')

@section('title', 'x-store | Личный кабинет')

@section('content')
    <div class="col-12 m-auto">
        <h4>Ваши подписки</h4>
        <div class="row">
            <div class="col-12 p-3">
                <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Изображение</th>
                        <th class="text-center" scope="col">Товар</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td class="text-center align-middle"><img src="{{ asset('storage/' . $subscription->position->image) }}" class="card-img-top" alt="Изображение недоступно"
                                                                      style="width: 150px; height: 150px"></td>
                            <td class="text-center align-middle"><a class="text-dark text-decoration-none" href="{{ route('positions.show', $subscription->position) }}">
                                    {{ $subscription->position->product->getField('title') }}
                                </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
