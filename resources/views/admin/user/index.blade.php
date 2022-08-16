@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Пользователи')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>{{ __('admin.users.users') }}</h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-secondary" href="#" style="pointer-events: none">{{ __('admin.users.users') }}</a>
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-9 m-auto">
        <x-admin.table-layout>
            <x-slot:cardTitle>
                <a href="{{ route('admin.users.create') }}"
                   class="btn btn-sm btn-success">{{ __('admin.create') }}</a>
            </x-slot:cardTitle>
            <x-slot:cardTools>
                <form action="#" method="get">
                    <x-filters.filter-search placeholder="email"/>
                </form>
            </x-slot:cardTools>
            <x-slot:tableHeaders>
                <th scope="col">#</th>
                <th scope="col">email</th>
                <th scope="col" class="text-center">{{ __('admin.orders.count_orders') }}</th>
                <th scope="col" class="text-center">{{ __('admin.users.date_register') }}</th>
                <th scope="col" class="text-center">{{ __('admin.actions') }}</th>
            </x-slot:tableHeaders>
            <x-slot:tableContent>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td><a class="text-dark"
                               href="{{ route('admin.users.show', $user) }}">{{ $user->email }}</a>
                        </td>
                        <td class="text-center">{{ $user->orders->count() }}</td>
                        <td class="text-center">{{ $user->created_at->format('d-m-Y') }}</td>
                        <td class="pt-1 text-center">
                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="post">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('admin.users.show', $user) }}"
                                   class="btn text-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </a>
                                <button class="btn border-0 bg-transparent text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-slot:tableContent>
            <x-slot:paginate>
                <div class="d-flex justify-content-center paginate mt-4">
                    {{ $users->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </x-slot:paginate>
        </x-admin.table-layout>
    </div>
@endsection
