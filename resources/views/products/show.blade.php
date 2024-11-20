<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ürün Detayı') }}
            </h2>
            @can('update', $product)
                <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Düzenle
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Ürün Bilgileri</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600">Ürün Adı:</p>
                                <p class="font-semibold">{{ $product->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Fiyat:</p>
                                <p class="font-semibold">{{ number_format($product->price, 2) }} TL</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-600">Açıklama:</p>
                                <p class="font-semibold">{{ $product->description }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Satıcı:</p>
                                <p class="font-semibold">{{ $product->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Oluşturulma Tarihi:</p>
                                <p class="font-semibold">{{ $product->created_at->format('d.m.Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
