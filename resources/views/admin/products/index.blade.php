@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/50 animate-gradient">
    <div class="container mx-auto px-6 py-8">
        <!-- Başlık Alanı -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4 animate-fade-in-left">
                <div class="p-3 bg-white/40 backdrop-blur-xl rounded-2xl shadow-soft">
                    <i class="ri-shopping-bag-3-line text-3xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Məhsullar
                    </h2>
                    <p class="text-slate-500 mt-1">Məhsul siyahısı və idarəetmə</p>
                </div>
            </div>
            
            <a href="{{ route('admin.products.create') }}" 
               class="group px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl
                      hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 
                      hover:shadow-soft-xl hover:scale-105 animate-fade-in-right">
                <div class="flex items-center space-x-2">
                    <i class="ri-add-line transition-transform group-hover:rotate-180"></i>
                    <span>Yeni Məhsul</span>
                </div>
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="animate-fade-in-up mb-6">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl flex items-center space-x-3">
                    <i class="ri-checkbox-circle-line text-2xl text-emerald-500"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Products Table -->
        <div class="bg-white/40 backdrop-blur-xl rounded-3xl shadow-soft-2xl border border-white/40 overflow-hidden animate-fade-in-up">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50/90 to-blue-50/90 border-b border-slate-200/60">
                            <th class="py-4 px-6 text-left font-medium text-slate-700">Şəkil</th>
                            <th class="py-4 px-6 text-left font-medium text-slate-700">Məhsul Adı</th>
                            <th class="py-4 px-6 text-left font-medium text-slate-700">Qiymət</th>
                            <th class="py-4 px-6 text-left font-medium text-slate-700">Stok</th>
                            <th class="py-4 px-6 text-center font-medium text-slate-700">Əməliyyatlar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/60">
                        @foreach($products as $product)
                            <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                <td class="py-4 px-6">
                                    <div class="relative group w-16 h-16 rounded-2xl overflow-hidden shadow-soft transition-transform hover:scale-105 duration-300">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                                <i class="ri-image-line text-2xl text-slate-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="font-medium text-slate-700">{{ $product->name }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-medium text-slate-700">{{ number_format($product->price, 2) }} ₼</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        {{ $product->stock > 10 ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $product->stock <= 10 && $product->stock > 0 ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $product->stock == 0 ? 'bg-rose-100 text-rose-700' : '' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-colors duration-200">
                                            <i class="ri-edit-line text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Bu məhsulu silmək istədiyinizə əminsiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-100 transition-colors duration-200">
                                                <i class="ri-delete-bin-line text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 animate-fade-in-up">
            {{ $products->links() }}
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