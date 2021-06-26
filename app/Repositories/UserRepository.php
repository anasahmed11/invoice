<?php

namespace App\Repositories;

use App\User;
use Symfony\Component\HttpFoundation\Request;

class UserRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $users = User::
            when($request->get('user_name'), function ($users) use ($request) {
                return $users->where('name', 'like', '%' . $request->query->get('user_name') . '%');
            })
            ->when($request->get('user_phone'), function ($users) use ($request) {
                return $users->where('phone', 'like', '%' . $request->query->get('user_phone') . '%');
            })->when($request->get('type'), function ($users) use ($request) {
                return $users->WhereHas('user_type', function ($users) use ($request){
                    $users->where('name', 'like', '%' . $request->query->get('type') . '%');
                });
            })->when($request->get('user_email'), function ($users) use ($request) {
                return $users->where('email', 'like', '%' . $request->query->get('user_email') . '%');
            })
        ;
        return $users;
    }

}
