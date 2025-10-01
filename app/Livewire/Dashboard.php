<?php

namespace App\Livewire;

use App\Models\Asset;
use App\Models\Complaint;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_assets' => Asset::count(),
            'available_assets' => Asset::where('status', 'tersedia')->count(),
            'in_use_assets' => Asset::where('status', 'digunakan')->count(),
            'total_complaints' => Complaint::count(),
            'open_complaints' => Complaint::whereIn('status', ['baru', 'diproses'])->count(),
            'resolved_complaints' => Complaint::where('status', 'selesai')->count(),
        ];

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
            'recentComplaints' => $recentComplaints,
            'recentAssets' => $recentAssets,
        ])->layout('layouts.app');
    }
}
