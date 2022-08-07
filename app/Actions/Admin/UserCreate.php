<?php

namespace App\Actions\Admin;

use App\Mail\UserPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserCreate
{
    public function create(array $data)
    {
        $password = Str::random(8);
        $data['password'] = Hash::make($password);
        Mail::to($data['email'])->send(new UserPasswordMail($password));
        User::create($data);
    }
}
