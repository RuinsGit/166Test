@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Başlıq Sahəsi -->
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-2 rounded-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 text-transparent bg-clip-text">
                Admin İdarəetmə Paneli
            </h2>
        </div>
        <div class="flex space-x-3">
            
        </div>
    </div>

    <!-- Statistika Kartları -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- İstifadəçi Kartı -->
        <div class="bg-white rounded-2xl shadow-xl p-6 transform hover:scale-105 transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500">Ümumi İstifadəçi</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format(\App\Models\User::count()) }}</h3>
                    <div class="flex items-center mt-2 text-green-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span class="text-sm ml-1">12% Artım</span>
                    </div>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Məhsul Kartı -->
        <div class="bg-white rounded-2xl shadow-xl p-6 transform hover:scale-105 transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500">Ümumi Məhsul</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format(\App\Models\Product::count()) }}</h3>
                    <div class="flex items-center mt-2 text-blue-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span class="text-sm ml-1">8% Artım</span>
                    </div>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Sifariş Kartı -->
        <div class="bg-white rounded-2xl shadow-xl p-6 transform hover:scale-105 transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500">Ümumi Sifariş</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format(\App\Models\Order::count()) }}</h3>
                    <div class="flex items-center mt-2 text-pink-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span class="text-sm ml-1">15% Artım</span>
                    </div>
                </div>
                <div class="bg-pink-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Qrafik və Aktivlik Sahəsi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Qrafik Kartı -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Satış Qrafiki</h3>
            <div class="h-64 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl flex items-center justify-center">
                <!-- Buraya qrafik komponenti əlavə edilə bilər -->
                <p class="text-gray-500">Qrafik Sahəsi</p>
            </div>
        </div>

        <!-- Son Aktivliklər -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Son Aktivliklər</h3>
            <div class="space-y-4">
                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="bg-green-100 rounded-full p-2">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-800">Yeni sifariş alındı</p>
                        <p class="text-xs text-gray-500">2 dəqiqə əvvəl</p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="bg-blue-100 rounded-full p-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-800">Yeni istifadəçi qeydiyyatı</p>
                        <p class="text-xs text-gray-500">5 dəqiqə əvvəl</p>
                    </div>
                </div>

                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                    <div class="bg-yellow-100 rounded-full p-2">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-800">Stok xəbərdarlığı</p>
                        <p class="text-xs text-gray-500">15 dəqiqə əvvəl</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hover Animasiyaları */
    .hover\:scale-105:hover {
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    /* Gradient Animasiyası */
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .bg-gradient-animate {
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
    }
</style>
@endsection