<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        
        // Basic stats only for testing
        $stats = [
            'total_assets' => Asset::count(),
            'available_assets' => Asset::where('status', 'tersedia')->count(),
            'in_use_assets' => Asset::where('status', 'digunakan')->count(),
            'total_complaints' => Complaint::count(),
            'new_complaints' => Complaint::where('status', 'baru')->count(),
            'resolved_complaints' => Complaint::where('status', 'selesai')->count(),
        ];
        
        // Simple recent data
        $recentComplaints = Complaint::with(['asset', 'user'])
            ->latest()
            ->take(5)
            ->get();
            
        $recentAssets = Asset::with(['category'])
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'stats' => $stats,
            'user' => $user,
            'recentComplaints' => $recentComplaints,
            'recentAssets' => $recentAssets,
            'myAssets' => collect(),
            'urgentComplaints' => collect(),
        ])->layout('layouts.app');
    }

    // Commented out for debugging
    /*
    private function getStatsByRole($user) { ... }
    private function getRecentDataByRole($user) { ... }
    */

    public function quickAction($action)
    {
        $user = Auth::user();
        
        switch($action) {
            case 'create_asset':
                if ($user->isStaffIT()) {
                    return redirect()->route('assets.create');
                }
                break;
            case 'create_complaint':
                return redirect()->route('complaints.create');
                break;
            case 'view_reports':
                if ($user->isStaffIT() || $user->isPrincipal()) {
                    return redirect()->route('reports.index');
                }
                break;
            case 'manage_users':
                if ($user->isStaffIT()) {
                    return redirect()->route('users.index');
                }
                break;
        }
        
        session()->flash('error', 'Akses tidak diizinkan untuk aksi tersebut.');
    }
}
