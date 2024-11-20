@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 animate-fade-in">
    <!-- Başlık Alanı -->
    <div class="flex justify-between items-center mb-8 p-6 bg-white/80 backdrop-blur-xl rounded-2xl border border-slate-200/60 shadow-lg">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-blue-50 rounded-xl">
                <i class="ri-shopping-bag-3-line text-2xl text-blue-600"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Sifariş Detayı #{{ $order->id }}
                </h2>
                <span class="text-sm text-slate-500">{{ $order->created_at->format('d.m.Y H:i') }}</span>
            </div>
        </div>
        <a href="{{ route('admin.orders.index') }}" 
           class="px-6 py-3 bg-white text-slate-700 rounded-xl border border-slate-200 hover:bg-slate-50 
                  transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 flex items-center space-x-2">
            <i class="ri-arrow-left-line"></i>
            <span>Geri Dön</span>
        </a>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <!-- Sol Panel -->
        <div class="col-span-2 space-y-6">
            <!-- Ürünler Tablosu -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/60">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-6 flex items-center space-x-2">
                        <i class="ri-shopping-cart-2-line text-blue-600"></i>
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Məhsullar
                        </span>
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-slate-50 to-blue-50 border-b border-slate-200/60">
                                <tr>
                                    <th class="py-4 px-6 text-left text-sm font-semibold text-slate-600">Məhsul</th>
                                    <th class="py-4 px-6 text-center text-sm font-semibold text-slate-600">Miqdar</th>
                                    <th class="py-4 px-6 text-right text-sm font-semibold text-slate-600">Qiymət</th>
                                    <th class="py-4 px-6 text-right text-sm font-semibold text-slate-600">Cəmi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/60">
                                @foreach($order->items as $item)
                                    <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $item->product->image }}" 
                                                     alt="{{ $item->product->name }}"
                                                     class="w-12 h-12 rounded-xl object-cover ring-2 ring-slate-200/50">
                                                <span class="font-medium text-slate-700">{{ $item->product->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full font-medium">
                                                {{ $item->quantity }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right font-medium text-slate-600">
                                            {{ number_format($item->price, 2) }} ₼
                                        </td>
                                        <td class="py-4 px-6 text-right font-semibold text-slate-700">
                                            {{ number_format($item->price * $item->quantity, 2) }} ₼
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gradient-to-r from-slate-50 to-blue-50 border-t border-slate-200/60">
                                <tr>
                                    <td colspan="3" class="py-4 px-6 text-right font-medium text-slate-600">Ümumi:</td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="font-bold text-lg bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                            {{ number_format($order->total, 2) }} ₼
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Status Güncelleme -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/60 p-6">
                <h3 class="text-lg font-semibold mb-6 flex items-center space-x-2">
                    <i class="ri-refresh-line text-blue-600"></i>
                    <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Status Yenilə
                    </span>
                </h3>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    @method('PUT')
                    
                    <!-- Mevcut status'u göster -->
                    <div class="mb-4 flex-1">
                        <p class="text-sm text-slate-600 mb-2">Mövcud Status:</p>
                        <div class="px-4 py-2 bg-slate-50 rounded-xl border border-slate-200">
                            <span class="font-medium text-slate-700">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>

                    <!-- Yeni status seçimi -->
                    <div class="flex-1">
                        <label for="status" class="block text-sm text-slate-600 mb-2">Yeni Status:</label>
                        <select name="status" id="status" 
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-200">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                                🕒 Gözləyir
                            </option>
                            <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>
                                ✅ Təsdiqləndi
                            </option>
                            <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>
                                ❌ Ləğv edildi
                            </option>
                        </select>
                    </div>

                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl
                                   hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 
                                   transform hover:-translate-y-0.5 hover:shadow-lg flex items-center space-x-2">
                        <i class="ri-save-line"></i>
                        <span>Yenilə</span>
                    </button>
                </form>

                <!-- Hata mesajları -->
                @if($errors->any())
                    <div class="mt-4 p-4 bg-rose-100 text-rose-700 rounded-xl">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Başarı mesajı -->
                @if(session('success'))
                    <div class="mt-4 p-4 bg-emerald-100 text-emerald-700 rounded-xl flex items-center space-x-2">
                        <i class="ri-checkbox-circle-line"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sağ Panel -->
        <div class="space-y-6">
            <!-- Müştəri Məlumatları -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/60">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-6 flex items-center space-x-2">
                        <i class="ri-user-3-line text-blue-600"></i>
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Müştəri Məlumatları
                        </span>
                    </h3>

                    <div class="space-y-6">
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50/50 to-indigo-50/50 rounded-xl">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name) }}&background=3b82f6&color=fff" 
                                 alt="{{ $order->user->name }}" 
                                 class="w-16 h-16 rounded-xl ring-4 ring-white">
                            <div>
                                <h4 class="font-semibold text-slate-700">{{ $order->user->name }}</h4>
                                <p class="text-sm text-slate-500">{{ $order->user->email }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-white rounded-xl border border-slate-200/60">
                                <div class="flex items-center space-x-2 mb-2">
                                    <i class="ri-time-line text-blue-600"></i>
                                    <span class="font-medium text-slate-600">Sifariş Tarixi</span>
                                </div>
                                <p class="text-slate-700">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                            </div>

                            <div class="p-4 bg-white rounded-xl border border-slate-200/60">
                                <div class="flex items-center space-x-2 mb-2">
                                    <i class="ri-checkbox-circle-line text-blue-600"></i>
                                    <span class="font-medium text-slate-600">Status</span>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                    {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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