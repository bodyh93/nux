<?php

namespace App\Http\Controllers;

use App\Models\NuxUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthController extends Controller
{

    public function showRegistrationForm(): View
    {
        $user = NuxUser::create([
            'username' => 'amg',
            'phonenumber' => 'img',
        ]);
        dd($user);
        return view('user.register_form');
    }

    public function register(Request $request): RedirectResponse
    {
        dd($request->all());
//        $validator = Validator::make($request->all(), [
//            'username' => 'required|string|max:255|unique:users',
//            'phonenumber' => 'required|string|max:15',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors(), 422);
//        }

        $user = NuxUser::create([
            'username' => $request->input('username'),
            'phonenumber' => $request->input('phonenumber'),
        ]);

        return response()->redirectToRoute('link.create');
    }
}
