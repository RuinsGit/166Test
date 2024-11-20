<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .dashboard-card { @apply transform hover:scale-105 transition-all duration-300 ease-in-out; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-purple-600 via-pink-600 to-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-white hover:text-pink-200 transition-all duration-300">
                        E-Ticarət Admin
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('products.index') }}" 
                       class="text-white hover:text-pink-200 px-3 py-2 rounded-full hover:bg-white/10 transition-all duration-300">
                        Məhsullarım
                    </a>
                    <a href="{{ route('orders.index') }}" 
                       class="text-white hover:text-pink-200 px-3 py-2 rounded-full hover:bg-white/10 transition-all duration-300">
                        Sifarişlərim
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center text-white hover:text-pink-200 px-3 py-2 rounded-full hover:bg-white/10 transition-all duration-300">
                            <img class="h-8 w-8 rounded-full border-2 border-white mr-2" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" 
                                 alt="{{ Auth::user()->name }}">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-4 w-4 transition-transform duration-300" 
                                 :class="{'rotate-180': open}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1">
                            <a href="{{ route('profile.edit') }}" 
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 transition-all duration-300">
                                Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 transition-all duration-300">
                                    Çıxış
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- İstatistik Kartları -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="dashboard-card bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl shadow-xl p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 rounded-lg p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-white">Ümumi Məhsul</h3>
                        <p class="text-3xl font-bold text-white mt-1">{{ $statistics['total_products'] }}</p>
                    </div>
                </div>
            </div>

            <div class="dashboard-card bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl shadow-xl p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 rounded-lg p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-white">Ümumi Sifariş</h3>
                        <p class="text-3xl font-bold text-white mt-1">{{ $statistics['total_orders'] }}</p>
                    </div>
                </div>
            </div>

            <div class="dashboard-card bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl shadow-xl p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 rounded-lg p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-white">Gözləyən Sifarişlər</h3>
                        <p class="text-3xl font-bold text-white mt-1">{{ $statistics['pending_orders'] }}</p>
                    </div>
                </div>
            </div>

            <div class="dashboard-card bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-xl p-6">
                <div class="flex items-center">
                    <div class="bg-white/20 rounded-lg p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-white">Tamamlanan Sifarişlər</h3>
                        <p class="text-3xl font-bold text-white mt-1">{{ $statistics['completed_orders'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Son Eklenen Ürünler -->
        <div class="bg-white rounded-xl shadow-lg mb-8 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Son Əlavə Edilən Məhsullar</h2>
                <a href="{{ route('products.create') }}" 
                   class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all duration-300">
                    + Yeni Məhsul
                </a>
            </div>
            <div class="p-6">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">{{ $product->name }}</h3>
                                    <p class="text-gray-600 mb-3">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-purple-600 font-bold">{{ number_format($product->price, 2) }} ₼</span>
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="text-blue-600 hover:text-blue-800 transition-all duration-300">
                                            Düzəliş Et
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center text-purple-600 hover:text-purple-800 transition-all duration-300">
                            <span>Bütün Məhsulları Gör</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                @else
                    <p class="text-gray-600">Hələ məhsul əlavə edilməyib.</p>
                @endif
            </div>
        </div>

        <!-- Son Siparişler -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Son Sifarişlər</h2>
            </div>
            <div class="p-6">
                @if($orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b border-gray-100">
                                    <th class="px-6 py-3 text-gray-500 font-semibold">Sifariş №</th>
                                    <th class="px-6 py-3 text-gray-500 font-semibold">Tarix</th>
                                    <th class="px-6 py-3 text-gray-500 font-semibold">Məbləğ</th>
                                    <th class="px-6 py-3 text-gray-500 font-semibold">Status</th>
                                    <th class="px-6 py-3 text-gray-500 font-semibold">Əməliyyat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-all duration-300">
                                        <td class="px-6 py-4 font-medium">#{{ $order->id }}</td>
                                        <td class="px-6 py-4">{{ $order->created_at->format('d.m.Y') }}</td>
                                        <td class="px-6 py-4 font-medium">{{ number_format($order->total, 2) }} ₼</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $order->status === 'completed' ? 'Tamamlandı' : 'Gözləyir' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('orders.show', $order) }}"
                                               class="text-blue-600 hover:text-blue-800 transition-all duration-300">
                                                Detallı Bax
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('orders.index') }}" 
                           class="inline-flex items-center text-purple-600 hover:text-purple-800 transition-all duration-300">
                            <span>Bütün Sifarişləri Gör</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                @else
                    <p class="text-gray-600">Hələ sifariş yoxdur.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>