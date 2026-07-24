@extends('layouts.app')

@section('title', 'Dashboard - Capella Multidana')
@section('header', 'Dashboard')

@section('content')
<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-[24px] font-semibold text-on-surface mb-1" style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 32px; letter-spacing: -0.01em;">Dashboard Overview</h2>
            <p class="text-[14px] text-on-surface-variant">Monitor data pengajuan kredit nasabah.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary-container/10 rounded-bl-full -mr-8 -mt-8 pointer-events-none"></div>
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-lg bg-primary-container/20 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined fill">folder_open</span>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-[12px] font-semibold text-on-surface-variant mb-1" style="letter-spacing: 0.05em;">Total Pengajuan</p>
                <h3 class="text-[36px] font-bold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 44px; letter-spacing: -0.02em;">{{ number_format($stats['total']) }}</h3>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FEF3C7] rounded-bl-full -mr-8 -mt-8 pointer-events-none"></div>
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-lg bg-[#FEF3C7] flex items-center justify-center text-[#92400E]">
                    <span class="material-symbols-outlined fill">pending_actions</span>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-[12px] font-semibold text-on-surface-variant mb-1" style="letter-spacing: 0.05em;">Pending Review</p>
                <h3 class="text-[36px] font-bold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 44px; letter-spacing: -0.02em;">{{ number_format($stats['pending']) }}</h3>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#DCFCE7] rounded-bl-full -mr-8 -mt-8 pointer-events-none"></div>
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-lg bg-[#DCFCE7] flex items-center justify-center text-[#166534]">
                    <span class="material-symbols-outlined fill">check_circle</span>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-[12px] font-semibold text-on-surface-variant mb-1" style="letter-spacing: 0.05em;">Disetujui</p>
                <h3 class="text-[36px] font-bold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 44px; letter-spacing: -0.02em;">{{ number_format($stats['disetujui']) }}</h3>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant flex flex-col gap-2 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FEE2E2] rounded-bl-full -mr-8 -mt-8 pointer-events-none"></div>
            <div class="flex justify-between items-start">
                <div class="w-10 h-10 rounded-lg bg-[#FEE2E2] flex items-center justify-center text-[#991B1B]">
                    <span class="material-symbols-outlined fill">cancel</span>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-[12px] font-semibold text-on-surface-variant mb-1" style="letter-spacing: 0.05em;">Ditolak</p>
                <h3 class="text-[36px] font-bold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 44px; letter-spacing: -0.02em;">{{ number_format($stats['ditolak']) }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant flex flex-col">
            <div class="p-6 border-b border-outline-variant/30 flex justify-between items-center">
                <div>
                    <h3 class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">Tren Pengajuan Kredit</h3>
                    <p class="text-[12px] text-on-surface-variant mt-1" style="letter-spacing: 0.05em;">Volume pengajuan berdasarkan status selama 30 hari terakhir</p>
                </div>
                <div class="flex items-center gap-4 text-[12px]">
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-sm bg-primary-container"></span> Total</span>
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-sm bg-[#FEF3C7]"></span> Pending</span>
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-sm bg-[#DCFCE7]"></span> Disetujui</span>
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-sm bg-[#FEE2E2]"></span> Ditolak</span>
                </div>
            </div>
            <div class="flex-1 p-6 relative overflow-hidden rounded-b-[16px] flex flex-col justify-end" style="min-height: 300px;">
                @php
                    $maxTotal = collect($chartData)->max('total');
                    $maxTotal = max($maxTotal, 1);
                @endphp
                <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low to-transparent opacity-50"></div>
                <div class="w-full h-[220px] flex items-end justify-between gap-1 px-2 z-10 relative">
                    @foreach ($chartData as $day)
                        <div class="group relative flex-1 h-full flex items-end justify-center">
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-inverse-surface text-inverse-on-surface text-[11px] py-1.5 px-2.5 rounded-lg whitespace-nowrap z-20 shadow-md">
                                <div class="font-semibold">{{ $day['label'] }}</div>
                                <div class="text-[10px] opacity-80">Total: {{ $day['total'] }} | Pending: {{ $day['pending'] }} | Disetujui: {{ $day['disetujui'] }} | Ditolak: {{ $day['ditolak'] }}</div>
                            </div>
                            @if ($day['total'] > 0)
                                <div class="w-full max-w-[20px] rounded-t-sm bg-primary-container relative transition-all hover:opacity-80" style="height: {{ ($day['total'] / $maxTotal) * 100 }}%;">
                                    @if ($day['disetujui'] > 0)
                                        <div class="absolute bottom-0 left-0 w-full rounded-t-sm bg-[#DCFCE7]" style="height: {{ ($day['disetujui'] / $day['total']) * 100 }}%;"></div>
                                    @endif
                                    @if ($day['pending'] > 0)
                                        <div class="absolute left-0 w-full bg-[#FEF3C7]" style="bottom: {{ ($day['disetujui'] / $day['total']) * 100 }}%; height: {{ ($day['pending'] / $day['total']) * 100 }}%;"></div>
                                    @endif
                                </div>
                            @else
                                <div class="w-full max-w-[20px] h-[2px] bg-outline-variant/20 rounded-t-sm"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between px-2 mt-2 z-10 relative">
                    <span class="text-[10px] text-on-surface-variant">{{ $chartData[0]['label'] ?? '' }}</span>
                    <span class="text-[10px] text-on-surface-variant">{{ $chartData[29]['label'] ?? $chartData[count($chartData)-1]['label'] ?? '' }}</span>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-[16px] shadow-sm border border-outline-variant flex flex-col overflow-hidden">
            <div class="p-6 border-b border-outline-variant/30">
                <h3 class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">Pengajuan Terbaru</h3>
            </div>
            <div class="flex-1 overflow-y-auto">
                <div class="flex flex-col">
                    @forelse ($latestPengajuan as $item)
                        <a href="{{ route('pengajuan.show', $item) }}" class="p-4 border-b border-outline-variant/30 hover:bg-surface-container-low transition-colors flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center
                                    {{ $item->status === 'pending' ? 'bg-[#FEF3C7] text-[#92400E]' : ($item->status === 'disetujui' ? 'bg-[#DCFCE7] text-[#166534]' : 'bg-[#FEE2E2] text-[#991B1B]') }}">
                                    <span class="material-symbols-outlined text-[16px]">
                                        {{ $item->status === 'pending' ? 'schedule' : ($item->status === 'disetujui' ? 'check' : 'close') }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-[14px] text-on-surface font-semibold">{{ $item->customer_name }}</p>
                                    <p class="text-[12px] text-on-surface-variant">Rp{{ number_format($item->loan_amount, 0, ',', '.') }} &middot; {{ $item->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[12px] font-semibold whitespace-nowrap
                                {{ $item->status === 'pending' ? 'bg-[#FEF3C7] text-[#92400E]' : ($item->status === 'disetujui' ? 'bg-[#DCFCE7] text-[#166534]' : 'bg-[#FEE2E2] text-[#991B1B]') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </a>
                    @empty
                        <div class="p-6 text-center text-on-surface-variant text-[14px]">Belum ada pengajuan.</div>
                    @endforelse
                </div>
            </div>
            <div class="p-2 bg-surface-container-low/50 border-t border-outline-variant/30 text-center">
                <a href="{{ route('pengajuan.index') }}" class="text-primary font-semibold text-[12px] hover:underline w-full py-2 inline-block">
                    Lihat Semua Pengajuan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
