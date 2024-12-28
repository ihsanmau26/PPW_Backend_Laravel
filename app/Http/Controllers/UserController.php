<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexAdmins()
    {
        $admins = User::where('role', 'admin')->get();
        return response()->json($admins->makeHidden(['created_at', 'updated_at']));
    }

    public function showAdmin($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return response()->json($admin->makeHidden(['created_at', 'updated_at']));
    }
}
