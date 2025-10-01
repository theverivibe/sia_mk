<?php

namespace App\Livewire\Complaints;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $priorityFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $complaints = Complaint::with(['asset', 'user', 'assignedTo'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('ticket_number', 'like', '%' . $this->search . '%')
                        ->orWhere('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->priorityFilter, function ($query) {
                $query->where('priority', $this->priorityFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.complaints.index', [
            'complaints' => $complaints,
        ])->layout('layouts.app');
    }
}
