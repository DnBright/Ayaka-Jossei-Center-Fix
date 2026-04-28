<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(15);
        return view('admin.komunikasi', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }

    public function markAsRead($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);
        return back()->with('success', 'Pesan ditandai sebagai sudah dibaca.');
    }

    public function destroy($id)
    {
        Message::findOrFail($id)->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
