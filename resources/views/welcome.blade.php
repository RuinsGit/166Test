@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-purple-600 to-indigo-600 overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                        <span class="block">Ən yaxşı məhsullar</span>
                        <span class="block text-indigo-200">Ən sərfəli qiymətlər</span>
                    </h1>
                    <p class="mt-3 text-base text-indigo-100 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Yüksək keyfiyyətli məhsullarımızla tanış olun. Sərfəli qiymətlər və sürətli çatdırılma xidməti.
                    </p>
                    @auth
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start space-x-4">
                            <div class="rounded-md shadow">
                                <a href="{{ route('products.index') }}" 
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                    İndi Alış-veriş Et
                                </a>
                            </div>
                            <div class="rounded-md shadow">
                                <a href="{{ route('cart.index') }}" 
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10">
                                    <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Səbətə Bax
                                    @if(session('cart'))
                                        <span class="ml-2 bg-white text-green-600 text-xs font-bold px-2 py-1 rounded-full">
                                            {{ count(session('cart')) }}
                                        </span>
                                    @endif
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start space-x-4">
                            <div class="rounded-md shadow">
                                <a href="{{ route('login') }}" 
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                    Giriş
                                </a>
                            </div>
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}" 
                                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10">
                                    Qeydiyyat
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" 
             src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" 
             alt="">
    </div>
</div>

<!-- Yeni Ürünler -->
<div class="bg-white">
    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">Məhsullar</h2>
        
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach(\App\Models\Product::latest()->get() as $product)
            <div class="group relative bg-white rounded-lg shadow-sm overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-lg">
                <!-- Ürün Resmi -->
                <div class="relative w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-t-lg overflow-hidden group-hover:opacity-75">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-center object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Ürün Bilgileri -->
                <div class="p-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $product->name }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ Str::limit($product->description, 100) }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <p class="text-xl font-semibold text-indigo-600">
                            {{ number_format($product->price, 2) }} TL
                        </p>
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Səbətə At
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Özellikler -->
<div class="bg-gradient-to-r from-purple-600 to-indigo-600">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-y-12 gap-x-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Hızlı Teslimat -->
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-white mx-auto">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="mt-6 text-lg font-medium text-white">Sürətli Çatdırılma</h3>
                <p class="mt-2 text-base text-indigo-100">24 saat ərzində çatdırılma</p>
            </div>

            <!-- Güvenli Ödeme -->
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-white mx-auto">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="mt-6 text-lg font-medium text-white">Təhlükəsiz Ödəniş</h3>
                <p class="mt-2 text-base text-indigo-100">100% təhlükəsiz ödəmə</p>
            </div>

            <!-- 7/24 Destek -->
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-white mx-auto">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="mt-6 text-lg font-medium text-white">7/24 Dəstək</h3>
                <p class="mt-2 text-base text-indigo-100">Həmişə sizin yanınızda</p>
            </div>

            <!-- İade Garantisi -->
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-white mx-auto">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"/>
                    </svg>
                </div>
                <h3 class="mt-6 text-lg font-medium text-white">Geri Qaytarma Zəmanəti</h3>
                <p class="mt-2 text-base text-indigo-100">14 gün ərzində geri qaytarma</p>
            </div>
        </div>
    </div>
</div>

<!-- Kampanyalar -->
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="relative rounded-2xl overflow-hidden">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80" alt="" class="w-full h-full object-center object-cover">
            </div>
            <div class="relative bg-gray-900 bg-opacity-75 py-32 px-6 sm:py-40 sm:px-12 lg:px-16">
                <div class="relative max-w-3xl mx-auto flex flex-col items-center text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        <span class="block">Xüsusi Təkliflər</span>
                    </h2>
                    <p class="mt-3 text-xl text-white">
                        Yeni gələn məhsullarımızda 20% endirim fürsətini qaçırmayın!
                    </p>
                    <a href="#" class="mt-8 w-full block bg-white border border-transparent rounded-md py-3 px-8 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">
                        Təklifləri Kəşf Et
                    </a>
                </div>
            </div>
        </div>
</div>
@endsection