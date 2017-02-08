<?php

namespace App\Http\Controllers;

use App\User;
use App\Services\UserService;
use Datatables;
use Illuminate\Http\Request;

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
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
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
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
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
                $action = '<a href="'. route('users.edit', $user) .'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('users.show', $user) .'" class="btn btn-xs btn-success show-this m-l-10"><i class="fa fa-search-plus"></i> Lihat</a>';
                // $action .= '<a href="'. route('users.banned', $user) .'" class="btn btn-xs btn-warning banned-this"><i class="glyphicon glyphicon-zoom-in"></i> Banned</a>';
                $action .= '<a href="'. route('users.destroy', $user) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
