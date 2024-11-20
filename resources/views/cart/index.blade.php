@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Başlık -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Alış-veriş Səbəti
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    {{ count(session('cart', [])) }} məhsul
                </p>
            </div>

            @if(session('success'))
                <div class="rounded-md bg-green-50 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if(count(session('cart', [])) > 0)
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                    <!-- Ürün Listesi -->
                    <ul role="list" class="divide-y divide-gray-200">
                        @php $total = 0 @endphp
                        @foreach(session('cart', []) as $id => $item)
                            <li class="p-4 sm:p-6">
                                <div class="flex items-center">
                                    <!-- Ürün Resmi -->
                                    <div class="flex-shrink-0 w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                                        @if(isset($item['image']))
                                            <img src="{{ Storage::url($item['image']) }}" 
                                                 alt="{{ $item['name'] }}"
                                                 class="w-full h-full object-center object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Ürün Bilgileri -->
                                    <div class="ml-6 flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900">
                                                    {{ $item['name'] }}
                                                </h3>
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ number_format($item['price'], 2) }} TL
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <!-- Miktar Güncelleme -->
                                                <form action="{{ route('cart.update', $id) }}" 
                                                      method="POST" 
                                                      class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <label for="quantity-{{ $id }}" class="sr-only">Miqdar</label>
                                                    <select id="quantity-{{ $id }}" 
                                                            name="quantity" 
                                                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                            onchange="this.form.submit()">
                                                        @for($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </form>

                                                <!-- Silme Butonu -->
                                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Ara Toplam -->
                                        <div class="mt-4">
                                            <p class="text-sm font-medium text-gray-900">
                                                Cəmi: {{ number_format($item['price'] * $item['quantity'], 2) }} TL
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @php $total += $item['price'] * $item['quantity'] @endphp
                        @endforeach
                    </ul>

                    <!-- Toplam ve Butonlar -->
                    <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Ümumi Məbləğ</p>
                            <p>{{ number_format($total, 2) }} TL</p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">
                            Çatdırılma və vergilər sifarişi tamamlayarkən hesablanacaq.
                        </p>
                        <div class="mt-6 flex justify-end space-x-4">
                            <a href="{{ route('products.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Alış-verişə Davam Et
                            </a>
                            <a href="{{ route('checkout') }}" 
                               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                Sifarişi Tamamla
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Boş Sepet -->
                <div class="text-center py-12 bg-white shadow-sm rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Səbətiniz boşdur</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Alış-verişə başlamaq üçün məhsullarımıza göz atın.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Məhsullara Bax
                        </a>
                    </div>
                </div>
            @endif

            <!-- Önerilen Ürünler -->
            @if(isset($recommendedProducts) && count($recommendedProducts) > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Sizin üçün təklif olunan məhsullar</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recommendedProducts as $product)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                                    <p class="mt-1 text-gray-500">{{ number_format($product->price, 2) }} TL</p>
                                    <div class="mt-4">
                                        <form action="{{ route('cart.add', $product) }}" method="POST">
                                            @csrf
                                            <button type="submit" 
                                                    class="w-full bg-indigo-600 border border-transparent rounded-md py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700">
                                                Səbətə Əlavə Et
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 