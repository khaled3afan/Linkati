<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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

        if (request()->has('password')) {
            $roles['user.password'] = 'min:6';
        }

        if (request()->has('password')) {
//            $user_data['password'] = bcrypt($user_data['password']);
        } else {
//            $user_data['password'] = $user->password;
        }

        $notifications = [
            'newsletter' => (boolean)request()->has('notifications.newsletter'),
        ];

//        $profile_data['notifications'] = json_encode($notifications);

        if ($user->email != $request->email) {
            $user->sendEmailVerificationNotification();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'status' => 200,
            'message' => __('Account Updated!'),
            'data' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $username
     *
     * @return html|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Throwable
     */
    public function show($username)
    {
        $where = filter_var($username, FILTER_VALIDATE_INT) ? 'id' : 'username';
        $user = User::verified()
                    ->active()
                    ->using()
                    ->where($where, $username)
                    ->firstOrFail();

        if (auth()->check() && $user->isBlockedBy(auth()->id())) {
            return abort(404);
        }

        if ($where == 'id') {
            return redirect()->route('users.show', $user->username);
        }

        if (auth()->id() != $user->id || request()->has('public')) {
            $diaries = $user->diaries()
                            ->published()
                            ->public()
                            ->known()
                            ->latest('published_at')
                            ->paginate(9);
        } else {
            $diaries = $user->diaries()->completed()->latest('published_at')->paginate(9);
        }

        // $comments = $user->comments()
        // ->whereRaw('id IN (select MAX(id) FROM comments GROUP BY commentable_id)')
        // ->latest()
        // ->paginate(6);

        if (request()->ajax()) {
            return $this->loadmore($diaries);
        }

        return view('users.show', compact('user', 'diaries'));
    }

    /**
     * @param $username
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function following($username)
    {
        $user = User::using()->verified()->whereUsername($username)->firstOrFail();

        $following = $user->following()->latest()->paginate(12);

        $items = '';
        foreach ($following as $follower) {
            $items .= view('users.loop.following', compact('follower'))->render();
        }

        // AppLog('Show user following: @'. $user->username);
        return response()->json([
            'currentPage' => $following->currentPage(),
            'lastPage' => $following->lastPage(),
            'items' => $items,
        ]);
    }

    /**
     * @param $username
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function followers($username)
    {
        $user = User::using()->verified()->whereUsername($username)->firstOrFail();

        $followers = $user->followers()->latest()->paginate(12);

        $items = '';
        foreach ($followers as $follower) {
            $items .= view('users.loop.followers', compact('follower'))->render();
        }

        // AppLog('Show user followers: @'. $user->username);
        return response()->json([
            'currentPage' => $followers->currentPage(),
            'lastPage' => $followers->lastPage(),
            'items' => $items,
        ]);
    }

    /**
     * @param $username
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function block($username)
    {
        $user = User::using()->verified()->whereUsername($username)->firstOrFail();

        if ($user->id != auth()->id() && auth()->user()->block($user->id)) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'type' => 'success',
                'title' => trans('strings.great'),
                'message' => trans('strings.user-has-been-blocked'),
            ]);
        }

        return response()->json([
            'status' => Response::HTTP_FORBIDDEN,
            'type' => 'error',
            'title' => trans('strings.errors'),
            'message' => trans('strings.an-error-has-been-caused'),
        ]);

    }
}
