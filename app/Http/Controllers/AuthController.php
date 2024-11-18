<?php

namespace App\Http\Controllers;

use App\Services\NuxUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthController extends Controller
{

    public function showRegistrationForm(): View
    {
        session()->flush();
        session()->regenerate(true);
        return view('auth.register_form');
    }

    public function register(Request $request, NuxUserService $nuxUserService): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50',
            'phonenumber' => 'required|digits_between:7,16|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nuxUser = $nuxUserService->makeUser($request->get('username'), $request->get('phonenumber'));
        session(['nuxUser' => $nuxUser]);

        return response()->redirectToRoute("link.index");
    }
}
