<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserApprovalController extends Controller
{
    /**
     * Display users for approval
     */
    public function index()
    {
        $users = User::where('role', '!=', 'kabid')
            ->with(['approvedByUser'])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('UserApproval/Index', [
            'users' => $users
        ]);
    }

    /**
     * Update user approval status
     */
    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'action' => 'required|in:approve,reject',
            'approval_notes' => 'nullable|string|max:1000'
        ]);

        if ($request->action !== 'approve' && !$request->approval_notes) {
            return redirect()->back()->withErrors(['approval_notes' => 'Alasan diperlukan untuk menolak akun.']);
        }

        $user = User::findOrFail($request->user_id);

        if ($request->action === 'approve') {
            $user->update([
                'is_approved' => true,
                'approved_at' => now(),
                'approved_by' => $request->user()->id,
                'approval_notes' => $request->approval_notes
            ]);
            $message = "Akun {$user->name} telah disetujui.";
        } else {
            $user->update([
                'is_approved' => false,
                'approved_at' => null,
                'approved_by' => null,
                'approval_notes' => $request->approval_notes
            ]);
            $message = "Akun {$user->name} telah ditolak.";
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Revoke approval from a user
     */
    public function revoke(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'approval_notes' => 'required|string|max:1000'
        ]);

        $user = User::findOrFail($request->user_id);

        $user->update([
            'is_approved' => false,
            'approved_at' => null,
            'approved_by' => null,
            'approval_notes' => $request->approval_notes
        ]);

        return redirect()->back()->with('success', "Persetujuan akun {$user->name} telah dicabut.");
    }
}
