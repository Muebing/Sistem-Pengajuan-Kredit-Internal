<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Capella Multidana')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background min-h-screen flex font-sans antialiased">
    <aside class="hidden md:flex fixed left-0 top-0 h-screen flex-col p-4 border-r border-outline-variant bg-surface-container-low w-64 z-50">
        <div class="flex items-center gap-2 mb-8 px-2">
            <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center">
                <span class="material-symbols-outlined fill text-on-primary-container">account_balance</span>
            </div>
            <div>
                <h1 class="text-[18px] font-bold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">Capella Multidana</h1>
                <p class="text-[12px] text-on-surface-variant">Internal Portal</p>
            </div>
        </div>

        <a href="{{ route('pengajuan.create') }}"
           class="w-full bg-primary text-on-primary hover:bg-on-primary-fixed-variant transition-colors rounded-lg py-2 px-4 text-[12px] font-semibold flex items-center justify-center gap-2 shadow-sm mb-6">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Tambah Pengajuan
        </a>

        <nav class="flex-1 flex flex-col gap-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 {{ request()->routeIs('dashboard') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-secondary-fixed-variant hover:bg-surface-container-high' }} rounded-lg px-4 py-2 transition-all text-[12px] font-semibold">
                <span class="material-symbols-outlined text-[18px] {{ request()->routeIs('dashboard') ? 'fill' : '' }}">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('pengajuan.index') }}"
               class="flex items-center gap-3 {{ request()->routeIs('pengajuan.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-secondary-fixed-variant hover:bg-surface-container-high' }} rounded-lg px-4 py-2 transition-all text-[12px] font-semibold">
                <span class="material-symbols-outlined text-[18px] {{ request()->routeIs('pengajuan.*') ? 'fill' : '' }}">description</span>
                Pengajuan Kredit
            </a>
        </nav>

        <div class="mt-auto flex flex-col gap-1 pt-4 border-t border-outline-variant">
            <a href="#" class="flex items-center gap-3 text-on-secondary-fixed-variant hover:bg-surface-container-high rounded-lg px-4 py-2 transition-all text-[12px] font-semibold">
                <span class="material-symbols-outlined text-[18px]">help</span>
                Help Center
            </a>
            <a href="#" class="flex items-center gap-3 text-on-secondary-fixed-variant hover:bg-surface-container-high rounded-lg px-4 py-2 transition-all text-[12px] font-semibold">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                Logout
            </a>
        </div>
    </aside>

    <div class="flex-1 md:ml-64 flex flex-col min-h-screen">
        <header class="flex justify-between items-center w-full px-6 h-16 sticky top-0 z-40 bg-surface shadow-sm border-b border-outline-variant/30">
            <form method="GET" action="{{ route('pengajuan.index') }}" class="relative w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input type="text"
                       name="search"
                       placeholder="Cari nama nasabah..."
                       class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant rounded-lg text-[14px] text-on-surface placeholder-on-surface-variant focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                       onkeydown="if(event.key==='Enter'){this.form.submit()}">
            </form>
            <div class="flex items-center gap-3">
                <button class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-full transition-colors flex items-center justify-center">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <button class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-full transition-colors flex items-center justify-center">
                    <span class="material-symbols-outlined">settings</span>
                </button>
                <div class="w-px h-8 bg-outline-variant mx-1"></div>
                <div class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition-opacity">
                    <div class="text-right hidden md:block">
                        <p class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">Admin User</p>
                        <p class="text-[12px] text-on-surface-variant" style="letter-spacing: 0.05em;">Capella Admin</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-secondary-container overflow-hidden border border-outline-variant shadow-sm flex items-center justify-center text-on-secondary-container">
                        <span class="material-symbols-outlined">person</span>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-8 bg-background">
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-outline-variant bg-surface-container-lowest p-4 text-[14px] text-on-surface flex items-center gap-3 shadow-sm" role="alert">
                    <div class="w-8 h-8 rounded-full bg-[#DCFCE7] flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[16px] text-[#166534]">check_circle</span>
                    </div>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-xl border border-outline-variant bg-surface-container-lowest p-4 text-[14px] text-on-surface flex items-center gap-3 shadow-sm" role="alert">
                    <div class="w-8 h-8 rounded-full bg-error-container flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[16px] text-error">error</span>
                    </div>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
