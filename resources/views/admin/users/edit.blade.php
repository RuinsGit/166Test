@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/50 animate-gradient">
    <div class="container mx-auto px-6 py-8">
        <!-- Başlık Alanı -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4 animate-fade-in-left">
                <div class="p-3 bg-white/40 backdrop-blur-xl rounded-2xl shadow-soft">
                    <i class="ri-user-settings-line text-3xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        İstifadəçi Düzənlə
                    </h2>
                    <p class="text-slate-500 mt-1">{{ $user->name }}</p>
                </div>
            </div>
            
            <a href="{{ route('admin.users.index') }}" 
               class="group px-6 py-3 bg-white/40 backdrop-blur-xl text-slate-700 rounded-2xl border border-white/40
                      hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white
                      transition-all duration-300 hover:shadow-soft-xl hover:scale-105 animate-fade-in-right">
                <div class="flex items-center space-x-2">
                    <i class="ri-arrow-left-line transition-transform group-hover:-translate-x-1"></i>
                    <span>Geri Dön</span>
                </div>
            </a>
        </div>

        <!-- Form Kartı -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white/40 backdrop-blur-xl rounded-3xl shadow-soft-2xl border border-white/40 p-8 animate-fade-in-up">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- İstifadəçi Avatar -->
                    <div class="flex justify-center mb-8">
                        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 
                                  flex items-center justify-center text-3xl text-blue-600 font-medium border border-blue-200/50
                                  transform hover:scale-105 transition-transform duration-300">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    </div>

                    <!-- Ad Soyad -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            Ad Soyad
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ri-user-line text-slate-400"></i>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                   class="w-full bg-white/60 backdrop-blur-xl rounded-xl border border-slate-200/60 pl-10 pr-4 py-3
                                          focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300
                                          hover:border-blue-400/60"
                                   placeholder="Ad və Soyadı daxil edin">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-rose-500 flex items-center space-x-1">
                                <i class="ri-error-warning-line"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-8">
                        <label for="email" class="block text-sm font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            Email
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ri-mail-line text-slate-400"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                   class="w-full bg-white/60 backdrop-blur-xl rounded-xl border border-slate-200/60 pl-10 pr-4 py-3
                                          focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300
                                          hover:border-blue-400/60"
                                   placeholder="Email ünvanını daxil edin">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-rose-500 flex items-center space-x-1">
                                <i class="ri-error-warning-line"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- İstifadəçi Rolu -->
                    <div class="mb-8">
                        <label for="role" class="block text-sm font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                            İstifadəçi Rolu
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ri-shield-user-line text-slate-400"></i>
                            </div>
                            <select name="role" id="role" 
                                    class="w-full bg-white/60 backdrop-blur-xl rounded-xl border border-slate-200/60 pl-10 pr-4 py-3
                                           focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all duration-300
                                           hover:border-blue-400/60 appearance-none cursor-pointer">
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>İstifadəçi</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="ri-arrow-down-s-line text-slate-400"></i>
                            </div>
                        </div>
                        @error('role')
                            <p class="mt-2 text-sm text-rose-500 flex items-center space-x-1">
                                <i class="ri-error-warning-line"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl
                                       hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 
                                       transform hover:scale-[1.02] hover:shadow-soft-xl">
                            <div class="flex items-center space-x-2">
                                <i class="ri-save-line text-xl group-hover:rotate-12 transition-transform duration-300"></i>
                                <span class="font-medium">Yenilə</span>
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-600/20 to-indigo-600/20 
                                      opacity-0 group-hover:opacity-100 blur transition-opacity duration-300"></div>
                        </button>
                    </div>
                </form>
            </div>
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

@keyframes fade-in-right {
    from { opacity: 0; transform: translateX(20px); }
    to { opacity: 1; transform: translateX(0); }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out;
}

.animate-fade-in-left {
    animation: fade-in-left 0.6s ease-out;
}

.animate-fade-in-right {
    animation: fade-in-right 0.6s ease-out;
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
</style>
@endsection