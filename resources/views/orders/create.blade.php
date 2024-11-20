@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Başlık -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Sifarişi Tamamla
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Zəhmət olmasa, çatdırılma məlumatlarını doldurun
                </p>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <form action="{{ route('orders.store') }}" method="POST" class="divide-y divide-gray-200">
                    @csrf

                    <!-- Teslimat Bilgileri -->
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700">
                                    Çatdırılma Ünvanı
                                </label>
                                <div class="mt-1">
                                    <textarea id="shipping_address" 
                                              name="shipping_address" 
                                              rows="3" 
                                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                              required>{{ old('shipping_address') }}</textarea>
                                </div>
                                @error('shipping_address')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    Telefon
                                </label>
                                <div class="mt-1">
                                    <input type="text" 
                                           name="phone" 
                                           id="phone" 
                                           value="{{ old('phone') }}"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                           required>
                                </div>
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="notes" class="block text-sm font-medium text-gray-700">
                                    Əlavə Qeydlər
                                </label>
                                <div class="mt-1">
                                    <textarea id="notes" 
                                              name="notes" 
                                              rows="2"
                                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sipariş Özeti -->
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            Sifariş Məlumatları
                        </h3>

                        <div class="space-y-4">
                            @php $total = 0 @endphp
                            @foreach(session('cart', []) as $id => $item)
                                <div class="flex justify-between items-center py-2">
                                    <div class="flex items-center">
                                        @if(isset($item['image']))
                                            <img src="{{ Storage::url($item['image']) }}" 
                                                 alt="{{ $item['name'] }}"
                                                 class="h-16 w-16 object-cover rounded">
                                        @endif
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h4>
                                            <p class="text-sm text-gray-500">{{ $item['quantity'] }} ədəd x {{ number_format($item['price'], 2) }} TL</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ number_format($item['price'] * $item['quantity'], 2) }} TL
                                    </span>
                                </div>
                                @php $total += $item['price'] * $item['quantity'] @endphp
                            @endforeach

                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-base font-medium text-gray-900">Ümumi Məbləğ</span>
                                    <span class="text-xl font-semibold text-gray-900">{{ number_format($total, 2) }} TL</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Butonlar -->
                    <div class="px-4 py-5 sm:p-6 bg-gray-50 flex justify-end space-x-3">
                        <a href="{{ route('cart.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Səbətə Qayıt
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Sifarişi Təsdiqlə
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection