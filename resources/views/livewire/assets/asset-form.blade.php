<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header Section -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            {{ $isEdit ? 'Edit Aset' : 'Tambah Aset Baru' }}
                        </h2>
                        <p class="text-gray-600 mt-1">
                            {{ $isEdit ? 'Perbarui informasi aset' : 'Lengkapi informasi aset baru' }}
                        </p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('assets.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>

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

                <!-- Form Section -->
                <form wire:submit.prevent="save" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information Card -->
                        <div class="md:col-span-2 bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Informasi Dasar</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Asset Name -->
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Aset <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="name"
                                           wire:model="name" 
                                           placeholder="Masukkan nama aset"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Asset Code -->
                                <div>
                                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kode Aset <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="code"
                                           wire:model="code" 
                                           placeholder="AST20250001"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('code') border-red-500 @enderror">
                                    @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="asset_category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <select id="asset_category_id"
                                            wire:model="asset_category_id" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('asset_category_id') border-red-500 @enderror">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('asset_category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Brand -->
                                <div>
                                    <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                                    <input type="text" 
                                           id="brand"
                                           wire:model="brand" 
                                           placeholder="Masukkan brand/merk"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('brand') border-red-500 @enderror">
                                    @error('brand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Model -->
                                <div>
                                    <label for="model" class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                                    <input type="text" 
                                           id="model"
                                           wire:model="model" 
                                           placeholder="Masukkan model"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('model') border-red-500 @enderror">
                                    @error('model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Serial Number -->
                                <div>
                                    <label for="serial_number" class="block text-sm font-medium text-gray-700 mb-2">Serial Number</label>
                                    <input type="text" 
                                           id="serial_number"
                                           wire:model="serial_number" 
                                           placeholder="Masukkan serial number"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('serial_number') border-red-500 @enderror">
                                    @error('serial_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Location -->
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                                    <input type="text" 
                                           id="location"
                                           wire:model="location" 
                                           placeholder="Masukkan lokasi aset"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('location') border-red-500 @enderror">
                                    @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status Information Card -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Status & Kondisi</h3>
                            
                            <div class="space-y-4">
                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select id="status"
                                            wire:model="status" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                                        @foreach($assetStatuses as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Condition -->
                                <div>
                                    <label for="condition" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kondisi <span class="text-red-500">*</span>
                                    </label>
                                    <select id="condition"
                                            wire:model="condition" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('condition') border-red-500 @enderror">
                                        @foreach($assetConditions as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('condition') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Assigned To -->
                                <div>
                                    <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-2">Ditugaskan Kepada</label>
                                    <select id="assigned_to"
                                            wire:model="assigned_to" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('assigned_to') border-red-500 @enderror">
                                        <option value="">Belum Ditugaskan</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                                        @endforeach
                                    </select>
                                    @error('assigned_to') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Purchase Information Card -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Informasi Pembelian</h3>
                            
                            <div class="space-y-4">
                                <!-- Purchase Date -->
                                <div>
                                    <label for="purchase_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pembelian</label>
                                    <input type="date" 
                                           id="purchase_date"
                                           wire:model="purchase_date" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('purchase_date') border-red-500 @enderror">
                                    @error('purchase_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Purchase Price -->
                                <div>
                                    <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Pembelian</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                        <input type="number" 
                                               id="purchase_price"
                                               wire:model="purchase_price" 
                                               placeholder="0"
                                               min="0"
                                               class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('purchase_price') border-red-500 @enderror">
                                    </div>
                                    @error('purchase_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Warranty End -->
                                <div>
                                    <label for="warranty_end" class="block text-sm font-medium text-gray-700 mb-2">Berakhir Garansi</label>
                                    <input type="date" 
                                           id="warranty_end"
                                           wire:model="warranty_end" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('warranty_end') border-red-500 @enderror">
                                    @error('warranty_end') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description Card -->
                        <div class="md:col-span-2 bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Deskripsi & Catatan</h3>
                            
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="description"
                                          wire:model="description" 
                                          rows="4"
                                          placeholder="Tambahkan deskripsi atau catatan tentang aset..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"></textarea>
                                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t">
                        <a href="{{ route('assets.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150 ease-in-out">
                            <i class="fas fa-save mr-2"></i>{{ $isEdit ? 'Perbarui' : 'Simpan' }} Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
