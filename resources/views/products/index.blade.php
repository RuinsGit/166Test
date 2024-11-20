@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Məhsullar</h1>
        <a href="{{ route('products.create') }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Yeni Məhsul
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 border-b text-left">Şəkil</th>
                    <th class="px-6 py-3 border-b text-left">Ad</th>
                    <th class="px-6 py-3 border-b text-left">Qiymət</th>
                    @if(auth()->user()->isAdmin())
                        <th class="px-6 py-3 border-b text-left">Satıcı</th>
                    @endif
                    <th class="px-6 py-3 border-b text-left">Əməliyyatlar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4 border-b">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-16 h-16 object-cover rounded">
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b">{{ $product->name }}</td>
                        <td class="px-6 py-4 border-b">{{ number_format($product->price, 2) }} TL</td>
                        @if(auth()->user()->isAdmin())
                            <td class="px-6 py-4 border-b">{{ $product->user->name }}</td>
                        @endif
                        <td class="px-6 py-4 border-b">
                            <div class="flex space-x-2">
                                <a href="{{ route('products.edit', $product) }}" 
                                   class="text-blue-500 hover:text-blue-700">
                                    Düzəlt
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Silmək istədiyinizə əminsiniz?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        Sil
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection