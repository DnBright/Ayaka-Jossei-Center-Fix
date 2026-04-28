<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $internalTeam = User::whereIn('role', ['admin', 'penulis'])->get();
        $pendingUsers = User::where('role', 'user')->where('is_approved', false)->get();
        $activeMembers = User::where('role', 'user')->where('is_approved', true)->get();

        return view('admin.users', compact('internalTeam', 'pendingUsers', 'activeMembers'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return back()->with('success', 'User ' . $user->name . ' telah berhasil disetujui.');
    }

    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        // We could just delete them or keep them as disapproved
        // The user says "jika admin tidak meng acc akun maka user tidak bisa login"
        // Deleting might be cleaner if they are rejected.
        $user->delete();

        return back()->with('success', 'Pendaftaran user telah ditolak.');
    }
}
