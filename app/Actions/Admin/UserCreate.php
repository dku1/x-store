<?php

namespace App\Actions\Admin;

use App\Jobs\SendMessage;
use App\Mail\UserPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserCreate
{
    public function create(array $data)
    {
        $password = Str::random(8);
        $data['password'] = Hash::make($password);
        SendMessage::dispatch($data['email'], new UserPasswordMail($password));
        User::create($data);
    }
}
