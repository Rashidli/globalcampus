<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::query()->where('user_id', auth()->user()->id)
            ->orderByDesc('created_at')->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markRead(Request $request)
    {
        $notification = Notification::where('id', $request->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->update(['is_read' => true]);

        return response()->json($notification);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void {}

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification): void {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification): void {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification): void {}


}
