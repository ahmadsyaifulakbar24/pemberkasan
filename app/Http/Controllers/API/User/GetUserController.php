<?php

namespace App\Http\Controllers\API\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => ['required', 'string'],
            'user_role' => ['nullable', 'in:200,201,202'],
        ]);

        $search = $request->search;
        $user = User::query();
        if($request->user_role){
            $user->where('role_id', $request->user_role);
        }
        $user->where('name', 'like', '%'.$search.'%')->orWhere('username', 'like', '%'.$search.'%')->limit(9);
        return ResponseFormatter::success(
            UserResource::collection($user->get()),
            'success get user data'
        );
    }
}
