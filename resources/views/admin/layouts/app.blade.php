<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .sidebar-link {
            @apply flex items-center px-4 py-3 text-gray-600 transition-all duration-300 hover:bg-slate-100/80 rounded-lg;
        }
        .sidebar-link.active {
            @apply bg-slate-800 text-white font-medium;
        }
        .sidebar-link:hover:not(.active) {
            @apply text-slate-900;
        }
        .menu-item {
            @apply flex items-center space-x-3 w-full;
        }
        .menu-icon {
            @apply text-xl;
        }
        .badge {
            @apply px-2 py-0.5 text-xs font-medium rounded-full ml-auto;
        }
        .badge-blue {
            @apply bg-blue-100 text-blue-700;
        }
        .badge-green {
            @apply bg-emerald-100 text-emerald-700;
        }
        .badge-purple {
            @apply bg-purple-100 text-purple-700;
        }
        .nav-header {
            background: #1e293b;
        }
        .content-area {
            background-color: #f8fafc;
        }
        .sidebar {
            background-color: #ffffff;
            box-shadow: 4px 0 10px rgba(0,0,0,0.03);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex">
        
        <div class="sidebar w-80 h-screen overflow-y-auto fixed left-0 top-0 border-r border-slate-200/60">
           
            <div class="h-16 flex items-center justify-between px-6 border-b border-slate-200/60">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-slate-800 rounded-lg flex items-center justify-center">
                        <i class="ri-code-s-slash-line text-xl text-white"></i>
                    </div>
                    <span class="text-lg font-semibold text-slate-800">AdminPanel</span>
                </div>
            </div>

            
            <div class="p-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <div class="menu-item">
                        <i class="ri-dashboard-3-line menu-icon"></i>
                        <span>İdarə Paneli</span>
                    </div>
                </a>

                
                <div class="pt-5 pb-2">
                    <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        E-TİCARƏT
                    </p>
                </div>

                <a href="{{ route('admin.products.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <div class="menu-item">
                        <i class="ri-shopping-bag-3-line menu-icon"></i>
                        <span>Məhsullar</span>
                        <span class="badge badge-blue">24</span>
                    </div>
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <div class="menu-item">
                        <i class="ri-shopping-cart-2-line menu-icon"></i>
                        <span>Sifarişlər</span>
                        <span class="badge badge-green">12</span>
                    </div>
                </a>

                
                <div class="pt-5 pb-2">
                    <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        İSTİFADƏÇİLƏR
                    </p>
                </div>

                <a href="{{ route('admin.users.index') }}" 
                   class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <div class="menu-item">
                        <i class="ri-user-3-line menu-icon"></i>
                        <span>Müştərilər</span>
                        <span class="badge badge-purple">891</span>
                    </div>
                </a>

                
                

               
            </div>

            
            <div class="absolute bottom-0 left-0 right-0 border-t border-slate-200/60 p-4">
                <div class="flex items-center space-x-3">
                    <img class="h-10 w-10 rounded-lg object-cover" 
                         src="https://ui-avatars.com/api/?name=Admin&background=1e293b&color=fff" 
                         alt="Admin">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">
                            Admin İstifadəçi
                        </p>
                        <p class="text-xs text-slate-500 truncate">
                            admin@example.com
                        </p>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                            <i class="ri-logout-box-r-line text-lg text-slate-400 hover:text-red-500"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="flex-1 ml-80">
            
            <nav class="nav-header h-16 flex items-center justify-between px-6 fixed top-0 right-0 left-80 z-30">
                <div class="flex items-center space-x-3">
                    <button class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
                        
                    </button>
                    <span class="text-white font-medium">E-Ticarət İdarəetmə Paneli</span>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors relative">
                        <i class="ri-notification-3-line text-xl text-white"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <button class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
                        <i class="ri-settings-4-line text-xl text-white"></i>
                    </button>
                </div>
            </nav>

           
            <div class="content-area pt-16 min-h-screen">
                <div class="p-6">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    
    @if(session('success'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="fixed bottom-4 right-4 bg-emerald-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
        <i class="ri-checkbox-circle-line text-xl"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif
</body>
</html>