<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return Inertia::render('users/Index', [
            'users' => $this->users->all()
        ]);
    }
}
