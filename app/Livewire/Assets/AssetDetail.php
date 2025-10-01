<?php

namespace App\Livewire\Assets;

use Livewire\Component;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AssetDetail extends Component
{
    public Asset $asset;
    public $showQrCode = false;
    public $showAssignModal = false;

    public function mount(Asset $asset)
    {
        $this->asset = $asset->load(['category', 'assignedUser']);
    }

    public function toggleQrCode()
    {
        $this->showQrCode = !$this->showQrCode;
    }

    public function toggleAssignModal()
    {
        $this->showAssignModal = !$this->showAssignModal;
    }

    public function generateQrCode()
    {
        $url = route('assets.show', $this->asset);
        // Simple QR Code generation (you'll need to install package)
        return "QR Code for: " . $url;
    }

    public function assignAsset($userId)
    {
        $user = auth()->user();
        
        if (!$user->isStaffIT()) {
            session()->flash('error', 'Anda tidak memiliki izin untuk mengassign aset.');
            return;
        }

        $this->asset->update([
            'assigned_to' => $userId,
            'status' => $userId ? 'digunakan' : 'tersedia'
        ]);

        $this->asset->refresh();
        $this->asset->load(['assignedUser']);
        $this->showAssignModal = false;

        session()->flash('success', 'Aset berhasil di-assign.');
    }

    public function unassignAsset()
    {
        $this->assignAsset(null);
    }

    public function getAvailableUsersProperty()
    {
        return User::whereIn('role', ['user', 'principal'])
                   ->where('id', '!=', $this->asset->assigned_to)
                   ->orderBy('name')
                   ->get();
    }

    public function render()
    {
        return view('livewire.assets.asset-detail', [
            'availableUsers' => $this->availableUsers,
            'qrCode' => $this->showQrCode ? $this->generateQrCode() : null,
        ])->layout('layouts.app');
    }
}
