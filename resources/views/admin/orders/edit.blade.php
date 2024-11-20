@extends('admin.layouts.app')

@section('content')
<div class="space-y-6 animate-fade-in">
    <!-- Başlık Alanı -->
    <div class="flex justify-between items-center p-6 bg-gradient-to-r from-slate-50 to-blue-50 rounded-2xl border border-slate-200/60 shadow-lg transition-all duration-300 hover:shadow-xl">
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
                <i class="ri-shopping-bag-3-line text-2xl text-blue-600"></i>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Sifariş #{{ $order->id }}
                </h2>
            </div>
            <span class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 
                {{ $order->status === 'pending' ? 'bg-amber-100/50 text-amber-700 border border-amber-200 animate-pulse' : '' }}
                {{ $order->status === 'approved' ? 'bg-emerald-100/50 text-emerald-700 border border-emerald-200' : '' }}
                {{ $order->status === 'canceled' ? 'bg-rose-100/50 text-rose-700 border border-rose-200' : '' }}">
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 rounded-full 
                        {{ $order->status === 'pending' ? 'bg-amber-500' : '' }}
                        {{ $order->status === 'approved' ? 'bg-emerald-500' : '' }}
                        {{ $order->status === 'canceled' ? 'bg-rose-500' : '' }}">
                    </div>
                    <span>
                        @switch($order->status)
                            @case('pending') Gözləyir @break
                            @case('approved') Təsdiqləndi @break
                            @case('canceled') Ləğv edildi @break
                        @endswitch
                    </span>
                </div>
            </span>
        </div>
        <button type="button" onclick="history.back()" 
                class="px-6 py-3 text-slate-700 bg-white/80 backdrop-blur border border-slate-200 rounded-xl 
                       hover:bg-slate-50 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 
                       focus:outline-none focus:ring-2 focus:ring-blue-500/40 group">
            <i class="ri-arrow-left-line mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
            Geri
        </button>
    </div>

    <!-- Ana Məzmun -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Sol Panel -->
        <div class="col-span-2 space-y-6">
            <!-- Status Güncelleme Kartı -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/60 transition-all duration-300 hover:shadow-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-6 flex items-center space-x-2">
                        <i class="ri-refresh-line text-blue-600"></i>
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Sifariş Statusunu Yenilə
                        </span>
                    </h3>

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="p-4 bg-gradient-to-r from-slate-50 to-blue-50 rounded-xl border border-slate-200/60">
                            <div class="flex items-center space-x-2">
                                <i class="ri-information-line text-blue-600"></i>
                                <p class="text-slate-600">Mövcud Status: 
                                    <strong class="text-slate-800">{{ $order->status }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-medium text-slate-700">
                                <i class="ri-edit-line mr-2 text-blue-600"></i>
                                Yeni Status:
                            </label>
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
                                class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl
                                       hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 
                                       transform hover:-translate-y-0.5 hover:shadow-lg flex items-center justify-center space-x-2">
                            <i class="ri-save-line"></i>
                            <span>Statusu Yenilə</span>
                        </button>
                    </form>

                    @if(session('success'))
                        <div class="mt-4 p-4 bg-emerald-100/50 backdrop-blur border border-emerald-200 text-emerald-700 rounded-xl animate-fade-in flex items-center space-x-2">
                            <i class="ri-checkbox-circle-line"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mt-4 p-4 bg-rose-100/50 backdrop-blur border border-rose-200 text-rose-700 rounded-xl animate-fade-in flex items-center space-x-2">
                            <i class="ri-error-warning-line"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Məhsullar Siyahısı -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/60 transition-all duration-300 hover:shadow-xl overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-6 flex items-center space-x-2">
                        <i class="ri-shopping-cart-2-line text-blue-600"></i>
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Sifariş Edilən Məhsullar
                        </span>
                    </h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-slate-50 to-blue-50 border-b border-slate-200/60">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-slate-600">Məhsul</th>
                                    <th class="px-6 py-4 text-center text-sm font-medium text-slate-600">Qiymət</th>
                                    <th class="px-6 py-4 text-center text-sm font-medium text-slate-600">Miqdar</th>
                                    <th class="px-6 py-4 text-right text-sm font-medium text-slate-600">Cəmi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/60">
                                @foreach($order->items as $item)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-4">
                                            @if($item->product)
                                                <img src="{{ $item->product->image }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="w-16 h-16 rounded-xl object-cover ring-2 ring-slate-200/50">
                                                <span class="font-medium text-slate-700">
                                                    {{ $item->product->name }}
                                                </span>
                                            @else
                                                <span class="font-medium text-slate-700">Silinmiş Məhsul</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-slate-600 font-medium">{{ number_format($item->price, 2) }} ₼</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full font-medium">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right font-semibold text-slate-700">
                                        {{ number_format($item->price * $item->quantity, 2) }} ₼
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gradient-to-r from-slate-50/50 to-blue-50/50 backdrop-blur border-t border-slate-200/60">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right font-medium text-slate-700">Ümumi:</td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="font-bold text-lg bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                            {{ number_format($order->total_amount, 2) }} ₼
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sağ Panel -->
        <div class="space-y-6">
            <!-- Müştəri Məlumatları -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/60 transition-all duration-300 hover:shadow-xl">
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

                        <div class="p-4 bg-white rounded-xl border border-slate-200/60">
                            <h4 class="font-semibold text-slate-700 mb-3 flex items-center">
                                <i class="ri-map-pin-line mr-2 text-blue-500"></i>
                                Çatdırılma Ünvanı
                            </h4>
                            <p class="text-slate-600">{{ $order->shipping_address }}</p>
                            <p class="text-slate-600 mt-2 flex items-center">
                                <i class="ri-phone-line mr-2 text-blue-500"></i>
                                {{ $order->phone }}
                            </p>
                        </div>

                        @if($order->billing_address)
                        <div class="p-4 bg-white rounded-xl border border-slate-200/60">
                            <h4 class="font-semibold text-slate-700 mb-3 flex items-center">
                                <i class="ri-bill-line mr-2 text-blue-500"></i>
                                Faktura Ünvanı
                            </h4>
                            <p class="text-slate-600">{{ $order->billing_address }}</p>
                        </div>
                        @endif

                        <div class="p-4 bg-white rounded-xl border border-slate-200/60">
                            <h4 class="font-semibold text-slate-700 mb-3 flex items-center">
                                <i class="ri-time-line mr-2 text-blue-500"></i>
                                Sifariş Tarixi
                            </h4>
                            <p class="text-slate-600">{{ $order->created_at->format('d.m.Y H:i') }}</p>
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