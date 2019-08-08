<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $user = auth()->user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);


        if ($user->email != $request->email) {
            $user->sendEmailVerificationNotification();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'settings' => $request->settings,
        ]);

        return response()->json([
            'status' => 200,
            'message' => __('Account Updated!'),
            'data' => $user
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        $user = auth()->user();

        // The passwords matches
        if ( ! (Hash::check($request->current_password, $user->password))) {
            return response()->json([
                'errors' => [
                    'current_password' => [
                        __('Your current password does not matches with the password you provided. Please try again.')
                    ]
                ]
            ], 422);
        }

        //Current password and new password are same
        if (strcmp($request->current_password, $request->new_password) == 0) {
            return response()->json([
                'errors' => [
                    'new_password' => [
                        __('New Password cannot be same as your current password. Please choose a different password.')
                    ]
                ]
            ], 422);
        }

        //Change Password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => __('Password changed successfully!'),
            'data' => $user,
        ]);
    }
}
