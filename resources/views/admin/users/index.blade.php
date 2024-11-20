@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/50 animate-gradient">
    <div class="container mx-auto px-6 py-8">
        <!-- Başlık Alanı -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4 animate-fade-in-left">
                <div class="p-3 bg-white/40 backdrop-blur-xl rounded-2xl shadow-soft">
                    <i class="ri-user-3-line text-3xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        İstifadəçi İdarəetməsi
                    </h2>
                    <p class="text-slate-500 mt-1">Admin və istifadəçi siyahısı</p>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="animate-fade-in-up mb-6">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl flex items-center space-x-3">
                    <i class="ri-checkbox-circle-line text-2xl text-emerald-500"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- İki Sütunlu Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Admin Tablosu -->
            <div class="bg-white/40 backdrop-blur-xl rounded-3xl shadow-soft-2xl border border-white/40 overflow-hidden animate-fade-in-up">
                <div class="p-4 border-b border-slate-200/60 bg-gradient-to-r from-slate-50/90 to-blue-50/90">
                    <h3 class="text-lg font-semibold text-slate-700 flex items-center space-x-2">
                        <i class="ri-shield-star-line text-indigo-600"></i>
                        <span>Adminlər</span>
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-50/90 to-blue-50/90 border-b border-slate-200/60">
                                <th class="py-4 px-6 text-left font-medium text-slate-700">Admin</th>
                                <th class="py-4 px-6 text-left font-medium text-slate-700">Email</th>
                                <th class="py-4 px-6 text-center font-medium text-slate-700">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200/60">
                            @foreach($users->where('role', 'admin') as $admin)
                                <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center text-blue-600 font-medium border border-blue-200/50">
                                                    {{ strtoupper(substr($admin->name, 0, 2)) }}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-700">{{ $admin->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <i class="ri-mail-line text-slate-400"></i>
                                            <span class="text-slate-600">{{ $admin->email }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.users.show', $admin) }}" 
                                               class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 
                                                      transition-all duration-200 hover:scale-105 tooltip"
                                               data-tooltip="Görüntülə">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $admin) }}" 
                                               class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-100 
                                                      transition-all duration-200 hover:scale-105 tooltip"
                                               data-tooltip="Düzənlə">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $admin) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Bu istifadəçini silmək istədiyinizə əminsiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-100 
                                                               transition-all duration-200 hover:scale-105 tooltip"
                                                        data-tooltip="Sil">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Normal Kullanıcılar Tablosu -->
            <div class="bg-white/40 backdrop-blur-xl rounded-3xl shadow-soft-2xl border border-white/40 overflow-hidden animate-fade-in-up">
                <div class="p-4 border-b border-slate-200/60 bg-gradient-to-r from-slate-50/90 to-blue-50/90">
                    <h3 class="text-lg font-semibold text-slate-700 flex items-center space-x-2">
                        <i class="ri-user-3-line text-blue-600"></i>
                        <span>İstifadəçilər</span>
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-50/90 to-blue-50/90 border-b border-slate-200/60">
                                <th class="py-4 px-6 text-left font-medium text-slate-700">İstifadəçi</th>
                                <th class="py-4 px-6 text-left font-medium text-slate-700">Email</th>
                                <th class="py-4 px-6 text-center font-medium text-slate-700">Əməliyyatlar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200/60">
                            @foreach($users->where('role', 'user') as $user)
                                <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center text-blue-600 font-medium border border-blue-200/50">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-700">{{ $user->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <i class="ri-mail-line text-slate-400"></i>
                                            <span class="text-slate-600">{{ $user->email }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.users.show', $user) }}" 
                                               class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 
                                                      transition-all duration-200 hover:scale-105 tooltip"
                                               data-tooltip="Görüntülə">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user) }}" 
                                               class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-100 
                                                      transition-all duration-200 hover:scale-105 tooltip"
                                               data-tooltip="Düzənlə">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Bu istifadəçini silmək istədiyinizə əminsiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-100 
                                                               transition-all duration-200 hover:scale-105 tooltip"
                                                        data-tooltip="Sil">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 animate-fade-in-up">
            {{ $users->links() }}
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

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out;
}

.animate-fade-in-left {
    animation: fade-in-left 0.6s ease-out;
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

.tooltip {
    position: relative;
}

.tooltip:before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 4px 8px;
    background-color: rgba(51, 65, 85, 0.9);
    color: white;
    font-size: 12px;
    border-radius: 6px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.tooltip:hover:before {
    opacity: 1;
    visibility: visible;
    bottom: calc(100% + 5px);
}
</style>
@endsection