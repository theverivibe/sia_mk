<?php

namespace App\Livewire\Assets;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\User;
use App\Enums\AssetStatus;
use App\Enums\AssetCondition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssetForm extends Component
{
    use WithFileUploads;

    public $asset;
    public $isEdit = false;

    // Asset properties
    public $name = '';
    public $code = '';
    public $asset_category_id = '';
    public $brand = '';
    public $model = '';
    public $serial_number = '';
    public $status = 'tersedia';
    public $condition = 'baik';
    public $purchase_date = '';
    public $purchase_price = '';
    public $warranty_end = '';
    public $location = '';
    public $description = '';
    public $assigned_to = '';

    // File upload
    public $image;
    public $existingImage = '';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:assets,code',
            'asset_category_id' => 'required|exists:asset_categories,id',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'status' => 'required|in:tersedia,digunakan,dalam_perbaikan,dihapuskan',
            'condition' => 'required|in:baik,rusak_ringan,rusak_berat,perlu_perbaikan',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'warranty_end' => 'nullable|date|after_or_equal:purchase_date',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'image' => 'nullable|image|max:2048', // 2MB max
        ];

        if ($this->isEdit) {
            $rules['code'] = 'required|string|max:50|unique:assets,code,' . $this->asset->id;
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'Nama aset wajib diisi',
        'code.required' => 'Kode aset wajib diisi',
        'code.unique' => 'Kode aset sudah digunakan',
        'asset_category_id.required' => 'Kategori aset wajib dipilih',
        'status.required' => 'Status aset wajib dipilih',
        'condition.required' => 'Kondisi aset wajib dipilih',
        'purchase_price.numeric' => 'Harga beli harus berupa angka',
        'warranty_end.after_or_equal' => 'Tanggal berakhir garansi tidak boleh sebelum tanggal pembelian',
        'image.image' => 'File harus berupa gambar',
        'image.max' => 'Ukuran gambar maksimal 2MB',
        'assigned_to.exists' => 'Pengguna yang dipilih tidak valid',
    ];

    public function mount($asset = null)
    {
        if ($asset) {
            $this->asset = $asset;
            $this->isEdit = true;
            $this->fill($asset->toArray());
            $this->existingImage = $asset->image_path;
            $this->purchase_date = $asset->purchase_date?->format('Y-m-d');
            $this->warranty_end = $asset->warranty_end?->format('Y-m-d');
        } else {
            $this->generateAssetCode();
        }
    }

    public function generateAssetCode()
    {
        $prefix = 'AST';
        $year = date('Y');
        $lastAsset = Asset::where('code', 'like', $prefix . $year . '%')
                         ->orderBy('code', 'desc')
                         ->first();

        if ($lastAsset) {
            $lastNumber = (int) substr($lastAsset->code, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $this->code = $prefix . $year . $newNumber;
    }

    public function updatedAssetCategoryId()
    {
        if (!$this->isEdit) {
            $this->generateAssetCode();
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'code' => $this->code,
                'asset_category_id' => $this->asset_category_id,
                'brand' => $this->brand,
                'model' => $this->model,
                'serial_number' => $this->serial_number,
                'status' => $this->status,
                'condition' => $this->condition,
                'purchase_date' => $this->purchase_date,
                'purchase_price' => $this->purchase_price,
                'warranty_end' => $this->warranty_end,
                'location' => $this->location,
                'description' => $this->description,
                'assigned_to' => $this->assigned_to ?: null,
            ];

            // Handle image upload
            if ($this->image) {
                // Delete old image if exists
                if ($this->isEdit && $this->existingImage) {
                    Storage::disk('public')->delete($this->existingImage);
                }

                $imagePath = $this->image->store('assets', 'public');
                $data['image_path'] = $imagePath;
            }

            if ($this->isEdit) {
                $this->asset->update($data);
                session()->flash('success', 'Aset berhasil diperbarui!');
            } else {
                Asset::create($data);
                session()->flash('success', 'Aset berhasil ditambahkan!');
            }

            return redirect()->route('assets.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteImage()
    {
        if ($this->isEdit && $this->existingImage) {
            Storage::disk('public')->delete($this->existingImage);
            $this->asset->update(['image_path' => null]);
            $this->existingImage = '';
            session()->flash('success', 'Gambar berhasil dihapus');
        }
    }

    public function getCategoriesProperty()
    {
        return AssetCategory::orderBy('name')->get();
    }

    public function getUsersProperty()
    {
        return User::whereIn('role', ['user', 'principal'])
                   ->orderBy('name')
                   ->get();
    }

    public function getAssetStatusesProperty()
    {
        return [
            'tersedia' => 'Tersedia',
            'digunakan' => 'Digunakan',
            'dalam_perbaikan' => 'Dalam Perbaikan',
            'dihapuskan' => 'Dihapuskan'
        ];
    }

    public function getAssetConditionsProperty()
    {
        return [
            'baik' => 'Baik',
            'rusak_ringan' => 'Rusak Ringan',
            'rusak_berat' => 'Rusak Berat',
            'perlu_perbaikan' => 'Perlu Perbaikan'
        ];
    }

    public function render()
    {
        return view('livewire.assets.asset-form', [
            'categories' => $this->categories,
            'users' => $this->users,
            'assetStatuses' => $this->assetStatuses,
            'assetConditions' => $this->assetConditions,
        ])->layout('layouts.app');
    }
}
