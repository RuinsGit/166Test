@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Başlık -->
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Sifarişi Tamamla
            </h1>
            <p class="mt-4 text-lg text-gray-600">
                Son bir neçə addım qaldı
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Sol Taraf - Sipariş Formu -->
                    <div class="p-6 sm:p-8 border-b md:border-b-0 md:border-r border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900 mb-6">Çatdırılma Məlumatları</h2>
                        
                        <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- İsim Soyisim -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">Ad</label>
                                    <input type="text" 
                                           name="first_name" 
                                           id="first_name"
                                           value="{{ auth()->user()->first_name ?? old('first_name') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           required>
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Soyad</label>
                                    <input type="text" 
                                           name="last_name" 
                                           id="last_name"
                                           value="{{ auth()->user()->last_name ?? old('last_name') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       value="{{ auth()->user()->email ?? old('email') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                            </div>

                            <!-- Telefon -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Telefon</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="tel" 
                                           name="phone" 
                                           id="phone"
                                           value="{{ old('phone') }}"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           required>
                                </div>
                            </div>

                            <!-- Adres -->
                            <div>
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700">
                                    Çatdırılma Ünvanı
                                </label>
                                <textarea name="shipping_address" 
                                          id="shipping_address" 
                                          rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                          required>{{ old('shipping_address') }}</textarea>
                            </div>

                            <!-- Notlar -->
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700">
                                    Sifariş Qeydləri
                                </label>
                                <textarea name="notes" 
                                          id="notes" 
                                          rows="2"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <!-- Sağ Taraf - Sipariş Özeti -->
                        <div class="p-6 sm:p-8 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900 mb-6">Sifariş Məlumatları</h2>

                            <div class="space-y-4">
                                @php $total = 0 @endphp
                                @foreach(session('cart', []) as $id => $item)
                                    <div class="flex items-center justify-between py-2">
                                        <div class="flex items-center">
                                            @if(isset($item['image']))
                                                <img src="{{ Storage::url($item['image']) }}" 
                                                     alt="{{ $item['name'] }}"
                                                     class="h-16 w-16 object-cover rounded">
                                            @endif
                                            <div class="ml-4">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h4>
                                                <p class="text-sm text-gray-500">{{ $item['quantity'] }} ədəd</p>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ number_format($item['price'] * $item['quantity'], 2) }} TL
                                        </span>
                                    </div>
                                    @php $total += $item['price'] * $item['quantity'] @endphp
                                @endforeach

                                <!-- Ara Çizgi -->
                                <div class="border-t border-gray-200 my-4"></div>

                                <!-- Toplam -->
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Məhsulların cəmi</span>
                                        <span class="text-sm font-medium text-gray-900">{{ number_format($total, 2) }} TL</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Çatdırılma</span>
                                        <span class="text-sm font-medium text-gray-900">Pulsuz</span>
                                    </div>
                                    <div class="flex justify-between pt-4 border-t border-gray-200">
                                        <span class="text-base font-medium text-gray-900">Ümumi Məbləğ</span>
                                        <span class="text-base font-medium text-gray-900">{{ number_format($total, 2) }} TL</span>
                                    </div>
                                </div>

                                <!-- Ödeme Butonları -->
                                <div class="mt-8 space-y-4">
                                    <button type="submit" 
                                            class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Sifarişi Təsdiqlə
                                    </button>
                                    <a href="{{ route('cart.index') }}" 
                                       class="w-full inline-flex justify-center items-center px-4 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Səbətə Qayıt
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Güvenlik Bildirimi -->
            <div class="mt-8 max-w-4xl mx-auto">
                <div class="rounded-md bg-gray-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-800">
                                Təhlükəsiz Ödəniş
                            </h3>
                            <div class="mt-2 text-sm text-gray-500">
                                <p>
                                    Bütün ödənişlər SSL şifrələmə ilə qorunur. Sizin məlumatlarınız tam təhlükəsizdir.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Telefon numarası formatı
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function(e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
</script>
@endpush
