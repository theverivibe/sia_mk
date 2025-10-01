<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - 
            @if($user->isStaffIT())
                <span class="text-blue-600">Staff IT</span>
            @elseif($user->isPrincipal())
                <span class="text-purple-600">Principal</span>
            @else
                <span class="text-green-600">User</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Quick Actions -->
            @if($user->isStaffIT() || $user->isUser())
            <div class="mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                        <div class="flex flex-wrap gap-3">
                            @if($user->isStaffIT())
                                <button wire:click="quickAction('create_asset')" 
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Aset
                                </button>
                                <button wire:click="quickAction('manage_users')"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                                    </svg>
                                    Kelola Users
                                </button>
                            @endif
                            
                            <a href="{{ route('complaints.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-md transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
                                </svg>
                                {{ $user->isUser() ? 'Ajukan Komplain' : 'Lihat Komplain' }}
                            </a>
                            
                            @if($user->isStaffIT() || $user->isPrincipal())
                                <button wire:click="quickAction('view_reports')"
                                        class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-md transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Laporan
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                @if($user->isUser())
                    <!-- User Statistics -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Aset Saya</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['my_assets'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Komplain</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['my_complaints'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Komplain Aktif</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['my_open_complaints'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Komplain Selesai</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['my_resolved_complaints'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Staff IT / Principal Statistics -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Aset</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_assets'] ?? 0 }}</p>
                                    <p class="text-xs text-gray-500">
                                        Tersedia: {{ $stats['available_assets'] ?? 0 }} | 
                                        Digunakan: {{ $stats['in_use_assets'] ?? 0 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-orange-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Komplain</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_complaints'] ?? 0 }}</p>
                                    <p class="text-xs text-gray-500">
                                        Baru: {{ $stats['new_complaints'] ?? 0 }} | 
                                        Diproses: {{ $stats['in_progress_complaints'] ?? 0 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Komplain Urgent</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['urgent_complaints'] ?? 0 }}</p>
                                    <p class="text-xs text-red-500">Perlu perhatian segera</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Komplain Selesai</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['resolved_complaints'] ?? 0 }}</p>
                                    <p class="text-xs text-green-500">Bulan ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Recent Data -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Complaints -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            {{ $user->isUser() ? 'Komplain Saya Terbaru' : 'Komplain Terbaru' }}
                        </h3>
                        @forelse($recentComplaints as $complaint)
                            <div class="border-b border-gray-200 py-3 last:border-b-0">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $complaint->title }}</p>
                                        <p class="text-xs text-gray-500">
                                            #{{ $complaint->ticket_number }} • 
                                            @if($complaint->asset)
                                                {{ $complaint->asset->name }}
                                            @else
                                                General Support
                                            @endif
                                        </p>
                                        @if(!$user->isUser())
                                            <p class="text-xs text-gray-500">Oleh: {{ $complaint->user->name }}</p>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($complaint->status === 'baru') bg-blue-100 text-blue-800
                                            @elseif($complaint->status === 'diproses') bg-yellow-100 text-yellow-800
                                            @elseif($complaint->status === 'selesai') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($complaint->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada komplain.</p>
                        @endforelse
                        <div class="mt-4">
                            <a href="{{ route('complaints.index') }}" 
                               class="text-sm text-blue-600 hover:text-blue-800">
                                Lihat semua komplain →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Assets -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            @if($user->isUser())
                                Aset Saya
                            @else
                                Aset Terbaru
                            @endif
                        </h3>
                        @php $assetList = $user->isUser() ? ($myAssets ?? collect()) : ($recentAssets ?? collect()); @endphp
                        @forelse($assetList as $asset)
                            <div class="border-b border-gray-200 py-3 last:border-b-0">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $asset->name }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $asset->code }} • {{ $asset->category->name ?? 'N/A' }}
                                        </p>
                                        @if(!$user->isUser() && $asset->assignedUser)
                                            <p class="text-xs text-gray-500">Assigned: {{ $asset->assignedUser->name }}</p>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($asset->status === 'tersedia') bg-green-100 text-green-800
                                            @elseif($asset->status === 'digunakan') bg-blue-100 text-blue-800
                                            @elseif($asset->status === 'dalam_perbaikan') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucwords(str_replace('_', ' ', $asset->status)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">
                                @if($user->isUser())
                                    Belum ada aset yang ditugaskan kepada Anda.
                                @else
                                    Belum ada aset terdaftar.
                                @endif
                            </p>
                        @endforelse
                        <div class="mt-4">
                            <a href="{{ route('assets.index') }}" 
                               class="text-sm text-blue-600 hover:text-blue-800">
                                {{ $user->isUser() ? 'Lihat aset saya' : 'Lihat semua aset' }} →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($urgentComplaints) && $urgentComplaints->count() > 0)
                <!-- Urgent Complaints Alert -->
                <div class="mt-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Komplain Urgent Membutuhkan Perhatian
                                </h3>
                                <div class="mt-2">
                                    @foreach($urgentComplaints as $complaint)
                                        <p class="text-sm text-red-700">
                                            • <strong>#{{ $complaint->ticket_number }}</strong>: {{ $complaint->title }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>