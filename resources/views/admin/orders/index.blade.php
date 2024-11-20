@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 animate-fade-in">
    <!-- Başlık ve İstatistikler -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <i class="ri-shopping-bag-3-line text-2xl text-blue-600"></i>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Sifarişlər
                </h2>
            </div>
            
            <!-- İstatistik Kartları -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white/80 backdrop-blur-xl p-4 rounded-xl border border-slate-200/60 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-emerald-100 rounded-lg">
                            <i class="ri-check-line text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Tamamlanan</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $orders->where('status', 'completed')->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur-xl p-4 rounded-xl border border-slate-200/60 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-amber-100 rounded-lg">
                            <i class="ri-time-line text-amber-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Gözləyən</p>
                            <p class="text-lg font-semibold text-slate-800">{{ $orders->where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur-xl p-4 rounded-xl border border-slate-200/60 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <i class="ri-money-dollar-circle-line text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Ümumi Satış</p>
                            <p class="text-lg font-semibold text-slate-800">{{ number_format($orders->sum('total'), 2) }} ₼</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bildirimler -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-100/50 backdrop-blur border border-emerald-200 text-emerald-700 rounded-xl animate-fade-in flex items-center space-x-2">
            <i class="ri-checkbox-circle-line"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Siparişler Tablosu -->
    <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/60 transition-all duration-300 hover:shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-slate-50 to-blue-50 border-b border-slate-200/60">
                    <tr>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-slate-600">Sifariş No</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-slate-600">Müştəri</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-slate-600">Tarix</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-slate-600">Status</th>
                        <th class="py-4 px-6 text-right text-sm font-semibold text-slate-600">Məbləğ</th>
                        <th class="py-4 px-6 text-center text-sm font-semibold text-slate-600">Əməliyyatlar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/60">
                    @foreach($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                            <td class="py-4 px-6">
                                <span class="font-medium text-slate-700">#{{ $order->id }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name) }}&background=3b82f6&color=fff" 
                                         alt="{{ $order->user->name }}" 
                                         class="w-8 h-8 rounded-lg">
                                    <div>
                                        <p class="font-medium text-slate-700">{{ $order->user->name }}</p>
                                        <p class="text-sm text-slate-500">{{ $order->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2 text-slate-600">
                                    <i class="ri-calendar-line text-blue-500"></i>
                                    <span>{{ $order->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 rounded-full text-xs font-medium 
                                    {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : '' }}
                                    {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700 border border-amber-200' : '' }}
                                    {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-700 border border-blue-200' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-rose-100 text-rose-700 border border-rose-200' : '' }}">
                                    <div class="flex items-center space-x-1">
                                        <div class="w-1.5 h-1.5 rounded-full 
                                            {{ $order->status === 'completed' ? 'bg-emerald-500' : '' }}
                                            {{ $order->status === 'pending' ? 'bg-amber-500' : '' }}
                                            {{ $order->status === 'processing' ? 'bg-blue-500' : '' }}
                                            {{ $order->status === 'cancelled' ? 'bg-rose-500' : '' }}">
                                        </div>
                                        <span>{{ ucfirst($order->status) }}</span>
                                    </div>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <span class="font-semibold text-slate-700">{{ number_format($order->total, 2) }} ₼</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('admin.orders.show', $order) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                                        <i class="ri-eye-line group-hover:scale-110 transition-transform duration-200"></i>
                                    </a>
                                    <a href="{{ route('admin.orders.edit', $order) }}" 
                                       class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors duration-200 group">
                                        <i class="ri-edit-line group-hover:scale-110 transition-transform duration-200"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $orders->links() }}
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