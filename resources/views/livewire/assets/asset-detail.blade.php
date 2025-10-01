<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $asset->name }}</h1>
                        <p class="text-gray-600 mt-1">
                            <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $asset->code }}</span>
                            <span class="mx-2">•</span>
                            <span class="text-sm">{{ $asset->category->name }}</span>
                        </p>
                    </div>
                    
                    <div class="flex flex-wrap gap-3">
                        <!-- Back Button -->
                        <a href="{{ route('assets.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>

                        @auth
                            @if(auth()->user()->isStaffIT())
                            <!-- Edit Button -->
                            <a href="{{ route('assets.edit', $asset) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a>

                            <!-- Assign Button -->
                            <button wire:click="toggleAssignModal" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                <i class="fas fa-user-plus mr-2"></i>Assign
                            </button>
                            @endif

                            <!-- QR Code Button -->
                            <button wire:click="toggleQrCode" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                <i class="fas fa-qrcode mr-2"></i>{{ $showQrCode ? 'Sembunyikan' : 'QR Code' }}
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Asset Status Badges -->
                <div class="flex flex-wrap gap-3 mb-6">
                    <!-- Status Badge -->
                    @switch($asset->status)
                        @case('tersedia')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Tersedia
                            </span>
                            @break
                        @case('digunakan')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-user mr-1"></i>Digunakan
                            </span>
                            @break
                        @case('dalam_perbaikan')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-tools mr-1"></i>Dalam Perbaikan
                            </span>
                            @break
                        @case('dihapuskan')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-trash mr-1"></i>Dihapuskan
                            </span>
                            @break
                    @endswitch

                    <!-- Condition Badge -->
                    @switch($asset->condition)
                        @case('baik')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-thumbs-up mr-1"></i>Kondisi Baik
                            </span>
                            @break
                        @case('rusak_ringan')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-exclamation-triangle mr-1"></i>Rusak Ringan
                            </span>
                            @break
                        @case('rusak_berat')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>Rusak Berat
                            </span>
                            @break
                        @case('perlu_perbaikan')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                <i class="fas fa-wrench mr-1"></i>Perlu Perbaikan
                            </span>
                            @break
                    @endswitch
                </div>

                <!-- QR Code Section -->
                @if($showQrCode)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                        <div class="text-center">
                            <div class="bg-white p-4 rounded-lg shadow border inline-block">
                                <!-- Placeholder for QR Code - you can implement actual QR generation later -->
                                <div class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded">
                                    <div class="text-center text-gray-500">
                                        <i class="fas fa-qrcode text-4xl mb-2"></i>
                                        <p class="text-xs">QR Code</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-lg font-medium text-gray-800 mb-2">QR Code Aset</h3>
                            <p class="text-gray-600 text-sm mb-2">Scan untuk mengakses detail aset ini dengan cepat</p>
                            <p class="text-xs text-gray-500 font-mono break-all">{{ route('assets.show', $asset) }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column - Asset Image and Basic Info -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Asset Image -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Foto Aset</h3>
                            <div class="aspect-square w-full">
                                @if($asset->image_path)
                                    <img src="{{ Storage::url($asset->image_path) }}" 
                                         alt="{{ $asset->name }}" 
                                         class="w-full h-full object-cover rounded-lg border">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg border">
                                        <div class="text-center text-gray-400">
                                            <i class="fas fa-image text-6xl mb-4"></i>
                                            <p class="text-sm">Tidak ada foto</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Assignment Info -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Assignment</h3>
                            @if($asset->assignedUser)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $asset->assignedUser->name }}</p>
                                            <p class="text-sm text-gray-500">{{ ucfirst($asset->assignedUser->role) }}</p>
                                        </div>
                                    </div>
                                    @auth
                                        @if(auth()->user()->isStaffIT())
                                        <button wire:click="unassignAsset" class="text-red-600 hover:text-red-900 text-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    @endauth
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-user-slash text-4xl text-gray-300 mb-2"></i>
                                    <p class="text-gray-500 text-sm">Belum di-assign ke pengguna</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column - Detailed Information -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Basic Details -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Detail Aset</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Nama Aset</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $asset->name ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Kode Aset</label>
                                    <p class="mt-1 text-sm text-gray-900 font-mono">{{ $asset->code ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Brand</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $asset->brand ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Model</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $asset->model ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Serial Number</label>
                                    <p class="mt-1 text-sm text-gray-900 font-mono">{{ $asset->serial_number ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Lokasi</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $asset->location ?: '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Purchase Information -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Informasi Pembelian</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Tanggal Beli</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $asset->purchase_date ? $asset->purchase_date->format('d M Y') : '-' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Harga Beli</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $asset->purchase_price ? 'Rp ' . number_format($asset->purchase_price, 0, ',', '.') : '-' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600">Berakhir Garansi</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $asset->warranty_end ? $asset->warranty_end->format('d M Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        @if($asset->description)
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Deskripsi</h3>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 text-sm whitespace-pre-line">{{ $asset->description }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Activity Timeline -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Riwayat Aktivitas</h3>
                            <div class="space-y-3">
                                <div class="flex items-center text-sm">
                                    <div class="flex-shrink-0 w-2 h-2 bg-blue-400 rounded-full"></div>
                                    <div class="ml-3">
                                        <p class="text-gray-700">Aset dibuat</p>
                                        <p class="text-gray-500 text-xs">{{ $asset->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                                @if($asset->updated_at != $asset->created_at)
                                <div class="flex items-center text-sm">
                                    <div class="flex-shrink-0 w-2 h-2 bg-green-400 rounded-full"></div>
                                    <div class="ml-3">
                                        <p class="text-gray-700">Terakhir diperbarui</p>
                                        <p class="text-gray-500 text-xs">{{ $asset->updated_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Modal -->
    @if($showAssignModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="toggleAssignModal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white" wire:click.stop>
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Assign Aset</h3>
                    <button wire:click="toggleAssignModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="space-y-3">
                    @if($asset->assignedUser)
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-800">Saat ini di-assign ke: <strong>{{ $asset->assignedUser->name }}</strong></p>
                        <button wire:click="unassignAsset" class="mt-2 text-red-600 hover:text-red-800 text-sm">
                            <i class="fas fa-times mr-1"></i>Unassign
                        </button>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Pengguna:</label>
                        <div class="max-h-48 overflow-y-auto space-y-2">
                            @forelse($availableUsers as $user)
                            <button wire:click="assignAsset({{ $user->id }})" 
                                    class="w-full text-left p-3 rounded-lg border hover:bg-gray-50 transition">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-600 text-xs"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ ucfirst($user->role) }}</p>
                                    </div>
                                </div>
                            </button>
                            @empty
                            <p class="text-gray-500 text-sm text-center py-4">Tidak ada pengguna yang tersedia</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
