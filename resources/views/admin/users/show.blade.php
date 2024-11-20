@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/50 animate-gradient">
    <div class="container mx-auto px-6 py-8">
        <!-- Başlık Alanı -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4 animate-fade-in-left">
                <div class="p-3 bg-white/40 backdrop-blur-xl rounded-2xl shadow-soft">
                    <i class="ri-user-search-line text-3xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        İstifadəçi Detalları
                    </h2>
                    <p class="text-slate-500 mt-1">{{ $user->name }}</p>
                </div>
            </div>
            
            <a href="{{ route('admin.users.index') }}" 
               class="group px-6 py-3 bg-white/40 backdrop-blur-xl text-slate-700 rounded-2xl border border-white/40
                      hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white
                      transition-all duration-300 hover:shadow-soft-xl hover:scale-105 animate-fade-in-right">
                <div class="flex items-center space-x-2">
                    <i class="ri-arrow-left-line transition-transform group-hover:-translate-x-1"></i>
                    <span>Geri Dön</span>
                </div>
            </a>
        </div>

        <!-- İstifadəçi Məlumatları -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sol Panel - İstifadəçi Məlumatları -->
            <div class="lg:col-span-1">
                <div class="bg-white/40 backdrop-blur-xl rounded-3xl shadow-soft-2xl border border-white/40 p-6 animate-fade-in-up">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 
                                    flex items-center justify-center text-3xl text-blue-600 font-medium border border-blue-200/50">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-slate-700">{{ $user->name }}</h3>
                            <p class="text-slate-500 flex items-center justify-center space-x-1 mt-1">
                                <i class="ri-mail-line"></i>
                                <span>{{ $user->email }}</span>
                            </p>
                        </div>
                        <div class="w-full pt-4 border-t border-slate-200/60">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Qeydiyyat Tarixi:</span>
                                <span class="font-medium text-slate-700">{{ $user->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sağ Panel - Sifarişlər -->
            <div class="lg:col-span-2">
                <div class="bg-white/40 backdrop-blur-xl rounded-3xl shadow-soft-2xl border border-white/40 p-6 animate-fade-in-up delay-100">
                    <div class="flex items-center space-x-3 mb-6">
                        <i class="ri-shopping-bag-3-line text-2xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"></i>
                        <h3 class="text-xl font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Sifarişlər
                        </h3>
                    </div>

                    @if($user->orders->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gradient-to-r from-slate-50/90 to-blue-50/90 border-b border-slate-200/60">
                                        <th class="py-4 px-6 text-left font-medium text-slate-700">Sifariş №</th>
                                        <th class="py-4 px-6 text-left font-medium text-slate-700">Tarix</th>
                                        <th class="py-4 px-6 text-left font-medium text-slate-700">Status</th>
                                        <th class="py-4 px-6 text-right font-medium text-slate-700">Cəmi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200/60">
                                    @foreach($user->orders as $order)
                                        <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                            <td class="py-4 px-6">
                                                <span class="font-medium text-slate-700">#{{ $order->id }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center space-x-2 text-slate-600">
                                                    <i class="ri-calendar-line text-slate-400"></i>
                                                    <span>{{ $order->created_at->format('d.m.Y H:i') }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                                    {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                                    {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                                    {{ $order->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : '' }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                <span class="font-medium text-slate-700">{{ number_format($order->total, 2) }} ₼</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="ri-shopping-bag-line text-3xl text-slate-400"></i>
                            </div>
                            <p class="text-slate-500">Hələ sifariş yoxdur.</p>
                        </div>
                    @endif
                </div>
            </div>
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

.delay-100 {
    animation-delay: 0.1s;
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