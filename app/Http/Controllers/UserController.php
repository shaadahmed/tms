<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    public function getUsers()
    {
        $users = $this->userRepository->all();
        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                return '<button class="btn btn-sm btn-warning" onclick="updateUser(' . $user->id . ')">Update</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser(' . $user->id . ')">Delete</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
