@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/50 animate-gradient">
    <div class="container mx-auto px-6 py-8">
        <!-- Başlık Alanı -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4 animate-fade-in-left">
                <div class="p-3 bg-white/40 backdrop-blur-xl rounded-2xl shadow-soft">
                    <i class="ri-edit-box-line text-3xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Məhsulu Düzənlə
                    </h2>
                    <p class="text-slate-500 mt-1">{{ $product->name }}</p>
                </div>
            </div>
            
            <a href="{{ route('admin.products.index') }}" 
               class="group px-6 py-3 bg-white/40 backdrop-blur-xl text-slate-700 rounded-2xl border border-white/40
                      hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white
                      transition-all duration-300 hover:shadow-soft-xl hover:scale-105 animate-fade-in-right">
                <div class="flex items-center space-x-2">
                    <i class="ri-arrow-left-line transition-transform group-hover:-translate-x-1"></i>
                    <span>Geri Dön</span>
                </div>
            </a>
        </div>

        <!-- Form Kartı -->
        <div class="bg-white/40 backdrop-blur-xl rounded-3xl shadow-soft-2xl border border-white/40 p-8 animate-fade-in-up">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Resim Yükleme Alanı -->
                <div class="mb-8">
                    <label class="inline-block text-lg font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                        Məhsul Şəkli
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Mevcut Resim -->
                        @if($product->image)
                        <div class="relative group rounded-2xl overflow-hidden shadow-soft-xl transition-transform hover:scale-[1.02] duration-300">
                            <img src="{{ Storage::url($product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-80 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300
                                        flex items-end justify-start p-6">
                                <p class="text-white font-medium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    Mövcud Şəkil
                                </p>
                            </div>
                        </div>
                        @endif

                        <!-- Yeni Resim Yükleme -->
                        <div class="flex items-center justify-center">
                            <label class="relative w-full h-80 flex flex-col items-center justify-center px-4 py-6 
                                        bg-white/60 backdrop-blur-xl rounded-2xl border-2 border-dashed border-blue-400/50 
                                        cursor-pointer hover:border-blue-600/50 transition-all duration-300 group
                                        hover:bg-blue-50/30">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div class="p-4 bg-blue-50 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                                        <i class="ri-upload-cloud-line text-4xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-lg font-medium text-slate-700">
                                            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Şəkil yükləmək üçün klikləyin</span>
                                        </p>
                                        <p class="mt-2 text-sm text-slate-500">və ya sürükləyin</p>
                                        <p class="mt-1 text-xs text-slate-400">PNG, JPG, GIF (MAX. 10mb)</p>
                                    </div>
                                </div>
                                <input type="file" name="image" class="hidden">
                            </label>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Məhsul Adı -->
                    <div class="form-group">
                        <label for="name" class="inline-block text-lg font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            Məhsul Adı
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                               class="w-full bg-white/60 backdrop-blur-xl rounded-xl border border-slate-200/60 px-4 py-3
                                      focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300
                                      hover:border-blue-400/60 placeholder-slate-400"
                               placeholder="Məhsulun adını daxil edin">
                        @error('name')
                            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Qiymət -->
                    <div class="form-group">
                        <label for="price" class="inline-block text-lg font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            Qiymət
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-slate-500">₼</span>
                            </div>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}"
                                   class="w-full bg-white/60 backdrop-blur-xl rounded-xl border border-slate-200/60 pl-8 pr-4 py-3
                                          focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300
                                          hover:border-blue-400/60 placeholder-slate-400"
                                   placeholder="0.00">
                        </div>
                        @error('price')
                            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div class="form-group">
                        <label for="stock" class="inline-block text-lg font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            Stok
                        </label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                               class="w-full bg-white/60 backdrop-blur-xl rounded-xl border border-slate-200/60 px-4 py-3
                                      focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300
                                      hover:border-blue-400/60 placeholder-slate-400"
                               placeholder="Stok miqdarını daxil edin">
                        @error('stock')
                            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Açıklama -->
                <div class="form-group">
                    <label for="description" class="inline-block text-lg font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                        Açıqlama
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full bg-white/60 backdrop-blur-xl rounded-xl border border-slate-200/60 px-4 py-3
                                     focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300
                                     hover:border-blue-400/60 placeholder-slate-400"
                              placeholder="Məhsul haqqında ətraflı məlumat...">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl
                                   hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 
                                   transform hover:scale-[1.02] hover:shadow-soft-xl">
                        <div class="flex items-center space-x-2">
                            <i class="ri-save-line text-xl group-hover:rotate-12 transition-transform duration-300"></i>
                            <span class="font-medium">Məhsulu Yenilə</span>
                        </div>
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-600/20 to-indigo-600/20 
                                  opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 15s ease infinite;
}

@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fade-in-left {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fade-in-right {
    from { opacity: 0; transform: translateX(20px); }
    to { opacity: 1; transform: translateX(0); }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out;
}

.animate-fade-in-left {
    animation: fade-in-left 0.6s ease-out;
}

.animate-fade-in-right {
    animation: fade-in-right 0.6s ease-out;
}

.shadow-soft {
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.06), 0 4px 6px rgba(59, 130, 246, 0.1);
}

.shadow-soft-xl {
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1), 0 5px 10px rgba(59, 130, 246, 0.04);
}

.shadow-soft-2xl {
    box-shadow: 0 25px 50px rgba(59, 130, 246, 0.15), 0 10px 20px rgba(59, 130, 246, 0.1);
}
</style>
@endsection