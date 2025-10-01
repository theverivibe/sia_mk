<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Sistem Inventaris Aset & Manajemen Komplain') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Assets -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Aset</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_assets'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-sm">
                            <span class="text-green-600">{{ $stats['available_assets'] }}</span> tersedia •
                            <span class="text-orange-600">{{ $stats['in_use_assets'] }}</span> digunakan
                        </div>
                    </div>
                </div>

                <!-- Total Complaints -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Komplain</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_complaints'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-sm">
                            <span class="text-red-600">{{ $stats['open_complaints'] }}</span> belum selesai •
                            <span class="text-green-600">{{ $stats['resolved_complaints'] }}</span> selesai
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-2">
                            <a href="{{ route('assets.index') }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Kelola Aset
                            </a>
                            <a href="{{ route('complaints.index') }}" class="block w-full text-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Kelola Komplain
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Data -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Complaints -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Komplain Terbaru</h3>
                        <div class="space-y-3">
                            @forelse($recentComplaints as $complaint)
                                <div class="border-l-4 @if($complaint->status === 'baru') border-red-500 @elseif($complaint->status === 'diproses') border-yellow-500 @else border-green-500 @endif pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $complaint->ticket_number }}</p>
                                            <p class="text-sm text-gray-600">{{ $complaint->title }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $complaint->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full @if($complaint->status === 'baru') bg-red-100 text-red-800 @elseif($complaint->status === 'diproses') bg-yellow-100 text-yellow-800 @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($complaint->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Belum ada komplain</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Assets -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aset Terbaru</h3>
                        <div class="space-y-3">
                            @forelse($recentAssets as $asset)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $asset->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $asset->code }} • {{ $asset->category->name ?? '-' }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $asset->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full @if($asset->status === 'tersedia') bg-green-100 text-green-800 @elseif($asset->status === 'digunakan') bg-blue-100 text-blue-800 @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($asset->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Belum ada aset</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
