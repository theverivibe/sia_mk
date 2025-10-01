<?php

namespace App\Livewire\Assets;

use App\Models\Asset;
use App\Models\AssetCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $conditionFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $assets = Asset::with(['category', 'assignedUser'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('code', 'like', '%' . $this->search . '%')
                        ->orWhere('serial_number', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('asset_category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->conditionFilter, function ($query) {
                $query->where('condition', $this->conditionFilter);
            })
            ->latest()
            ->paginate(10);

        $categories = AssetCategory::all();

        return view('livewire.assets.index', [
            'assets' => $assets,
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
