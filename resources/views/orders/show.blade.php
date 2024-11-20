@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Başlık ve Durum -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Sifariş #{{ $order->id }}
                </h1>
                <p class="mt-2 text-gray-600">
                    {{ $order->created_at->format('d.m.Y H:i') }} tarixində yaradıldı
                </p>
            </div>
            <div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'approved') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    @if($order->status === 'pending')
                        Gözləmədə
                    @elseif($order->status === 'approved')
                        Təsdiqləndi
                    @else
                        Ləğv edildi
                    @endif
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Sipariş Detayları -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Sifariş Məlumatları</h2>
                
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Çatdırılma Ünvanı</h3>
                        <p class="mt-1 text-gray-900">{{ $order->shipping_address }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Telefon</h3>
                        <p class="mt-1 text-gray-900">{{ $order->phone }}</p>
                    </div>

                    @if($order->notes)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Qeydlər</h3>
                            <p class="mt-1 text-gray-900">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Ödeme Detayları -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Ödəniş Məlumatları</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Ümumi Məbləğ</span>
                        <span class="text-xl font-semibold text-gray-900">{{ number_format($order->total_amount, 2) }} TL</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sipariş Ürünleri -->
        <div class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Məhsullar</h2>
            </div>

            <div class="divide-y divide-gray-200">
                @foreach($order->items as $item)
                    <div class="p-6 flex items-center">
                        <div class="flex-shrink-0 w-16 h-16">
                            @if($item->product->image)
                                <img src="{{ Storage::url($item->product->image) }}" 
                                     alt="{{ $item->product->name }}"
                                     class="w-full h-full object-cover rounded">
                            @else
                                <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="ml-6 flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ $item->product->name }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $item->quantity }} ədəd x {{ number_format($item->price, 2) }} TL
                                    </p>
                                </div>
                                <p class="text-lg font-medium text-gray-900">
                                    {{ number_format($item->quantity * $item->price, 2) }} TL
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Admin Kontrolleri -->
        @if(auth()->user()->isAdmin())
            <div class="mt-8 bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Sifariş İdarəetməsi</h2>
                
                <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    @method('PATCH')
                    
                    <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Gözləmədə</option>
                        <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>Təsdiqləndi</option>
                        <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>Ləğv edildi</option>
                    </select>

                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Statusu Yenilə
                    </button>
                </form>
            </div>
        @endif

        <!-- Geri Dönüş Butonu -->
        <div class="mt-8 flex justify-end">
            <a href="{{ route('orders.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Sifarişlərə Qayıt
            </a>
        </div>
    </div>
</div>
@endsection
