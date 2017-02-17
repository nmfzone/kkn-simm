<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\User;
use Datatables;

class UsersController extends Controller
{
    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * Constructor.
     *
     * @param  \App\Services\UserService  $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('users.view');

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('users.create');

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('users.create');

        $user = User::create($request->all());

        if ($user->position == 'Administrator') {
            $user->assign('Administrator');
        } else {
            $user->assign('RW');
        }

        if ($request->hasFile('photo')) {
            $this->userService->storeMedia($request->photo, $user);
        }

        alert()->success(trans('message.ctrl.users.store'))->persistent("Close");

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        if (! is_null($request->current_password)) {
            $this->validate($request, [
                'current_password' => 'old_password:' . $user->password,
                'password' => 'required_with:current_password|confirmed|min:6',
            ]);
        }

        $user->update($request->all());

        if ($user->position == 'Administrator') {
            $user->assign('Administrator');
        } else {
            $user->assign('RW');
        }

        if ($request->hasFile('photo')) {
            $this->userService->storeMedia($request->photo, $user);
        }

        alert()->success(trans('message.ctrl.users.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);

        $user->delete();

        alert()->success(trans('message.ctrl.users.destroy'))->persistent("Close");

        return redirect(route('users.index'));
    }

    /**
     * Banned the specified resource from the app.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function banned(User $user)
    {
        $this->authorize('users.banned');

        $user->is_banned = true;
        $user->save();

        alert()->success(trans('message.ctrl.users.banned'))->persistent("Close");

        return redirect(route('users.index'));
    }

    /**
     * Get all users by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers()
    {
        return Datatables::of(User::all())
            ->addColumn('action', function ($user) {
                $action = '<a href="'. route('users.edit', $user) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('users.banned', $user) .'" class="btn btn-xs btn-warning banned-this m-l-10"><i class="fa fa-warning"></i> Banned</a>';
                $action .= '<a href="'. route('users.destroy', $user) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
