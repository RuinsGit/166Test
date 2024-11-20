@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 animate-fade-in">
    <!-- Başlık Alanı -->
    <div class="flex justify-between items-center mb-8 p-6 bg-white/80 backdrop-blur-xl rounded-2xl border border-slate-200/60 shadow-lg">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-blue-50 rounded-xl">
                <i class="ri-add-box-line text-2xl text-blue-600"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Yeni Məhsul Əlavə Et
                </h2>
                <p class="text-sm text-slate-500">Məhsul məlumatlarını daxil edin</p>
            </div>
        </div>
        <a href="{{ route('admin.products.index') }}" 
           class="px-6 py-3 bg-white text-slate-700 rounded-xl border border-slate-200 hover:bg-slate-50 
                  transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 flex items-center space-x-2">
            <i class="ri-arrow-left-line"></i>
            <span>Geri Dön</span>
        </a>
    </div>

    <!-- Form Kartı -->
    <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/60 p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Resim Yükleme Alanı -->
            <div class="mb-8">
                <label for="image" class="block text-sm font-medium text-slate-700 mb-2">Məhsul Şəkli</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-blue-500 transition-colors duration-200">
                    <div class="space-y-2 text-center">
                        <div class="mx-auto h-24 w-24 text-slate-400">
                            <i class="ri-image-add-line text-5xl"></i>
                        </div>
                        <div class="flex text-sm text-slate-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Şəkil Yüklə</span>
                                <input id="image" name="image" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">və ya sürükləyib buraxın</p>
                        </div>
                        <p class="text-xs text-slate-500">PNG, JPG, GIF maksimum 10MB</p>
                    </div>
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- İki Sütunlu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Məhsul Adı -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-slate-700">Məhsul Adı</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200"
                           placeholder="Məhsulun adını daxil edin">
                    @error('name')
                        <p class="text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Qiymət -->
                <div class="space-y-2">
                    <label for="price" class="block text-sm font-medium text-slate-700">Qiymət</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-slate-500 sm:text-sm">₼</span>
                        </div>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}"
                               class="w-full rounded-xl border-slate-200 pl-7 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200"
                               placeholder="0.00">
                    </div>
                    @error('price')
                        <p class="text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stok -->
                <div class="space-y-2">
                    <label for="stock" class="block text-sm font-medium text-slate-700">Stok</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                           class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200"
                           placeholder="Stok miqdarını daxil edin">
                    @error('stock')
                        <p class="text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Açıklama -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-slate-700">Açıqlama</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200"
                          placeholder="Məhsul haqqında ətraflı məlumat...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl
                               hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 
                               transform hover:-translate-y-0.5 hover:shadow-lg flex items-center space-x-2">
                    <i class="ri-save-line"></i>
                    <span>Məhsul Əlavə Et</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }
</style>
@endsection