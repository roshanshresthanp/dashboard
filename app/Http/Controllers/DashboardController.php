<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // return view('admin.layouts.app');
        return view('admin.dashboard');
    }

    public function clearNotification()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success','Your notifications have been cleared.');
    }
}
