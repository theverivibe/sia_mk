<?php

namespace App\Livewire\Assets;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AssetList extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $conditionFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'conditionFilter' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingConditionFilter()
    {
        $this->resetPage();
    }

    public function sortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'categoryFilter', 'statusFilter', 'conditionFilter']);
        $this->resetPage();
    }

    public function deleteAsset($assetId)
    {
        $user = Auth::user();
        
        if (!$user->isStaffIT()) {
            session()->flash('error', 'Anda tidak memiliki izin untuk menghapus aset.');
            return;
        }

        $asset = Asset::findOrFail($assetId);
        $asset->delete();
        
        session()->flash('success', "Aset {$asset->name} berhasil dihapus.");
    }

    public function render()
    {
        $user = Auth::user();
        
        $query = Asset::with(['category', 'assignedUser']);

        // Role-based filtering
        if ($user->isUser()) {
            $query->where('assigned_to', $user->id);
        }

        // Search functionality
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('code', 'like', '%' . $this->search . '%')
                  ->orWhere('serial_number', 'like', '%' . $this->search . '%')
                  ->orWhere('brand', 'like', '%' . $this->search . '%')
                  ->orWhere('model', 'like', '%' . $this->search . '%');
            });
        }

        // Filters
        if ($this->categoryFilter) {
            $query->where('asset_category_id', $this->categoryFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->conditionFilter) {
            $query->where('condition', $this->conditionFilter);
        }

        // Sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        $assets = $query->paginate($this->perPage);
        $categories = AssetCategory::all();

        $statusOptions = [
            'tersedia' => 'Tersedia',
            'digunakan' => 'Digunakan', 
            'dalam_perbaikan' => 'Dalam Perbaikan',
            'dihapuskan' => 'Dihapuskan'
        ];

        $conditionOptions = [
            'baik' => 'Baik',
            'rusak_ringan' => 'Rusak Ringan',
            'rusak_berat' => 'Rusak Berat', 
            'perlu_perbaikan' => 'Perlu Perbaikan'
        ];

        return view('livewire.assets.asset-list', [
            'assets' => $assets,
            'categories' => $categories,
            'statusOptions' => $statusOptions,
            'conditionOptions' => $conditionOptions,
            'user' => $user,
        ])->layout('layouts.app');
    }
}
