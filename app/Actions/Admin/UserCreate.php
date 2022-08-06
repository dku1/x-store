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
        $role_ids = $data['role_ids'];
        unset($data['role_ids']);

        $password = Str::random(8);
        $data['password'] = Hash::make($password);

        Mail::to($data['email'])->send(new UserPasswordMail($password));

        $user = User::create($data);

        foreach ($role_ids as $id){
            $user->roles()->attach($id);
        }
    }
}
