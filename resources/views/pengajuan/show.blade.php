@extends('layouts.app')

@section('title', 'Detail Pengajuan - Capella Multidana')
@section('header', 'Detail Pengajuan')

@section('content')
<div class="max-w-5xl mx-auto flex flex-col gap-6 pb-8">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('pengajuan.index') }}" class="text-primary hover:underline text-[12px] font-semibold flex items-center gap-1 mb-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Daftar
            </a>
            <h2 class="text-[24px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">Detail Pengajuan <span class="text-outline">#{{ $pengajuan->id }}</span></h2>
        </div>
        <div class="flex items-center gap-2">
            @if ($pengajuan->status === 'pending')
                <span class="px-4 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant text-[12px] font-semibold inline-flex items-center gap-2 border border-tertiary-fixed-dim/50 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-tertiary-container"></span>
                    Menunggu Evaluasi
                </span>
            @elseif ($pengajuan->status === 'disetujui')
                <span class="px-4 py-1 rounded-full bg-[#DCFCE7] text-[#166534] text-[12px] font-semibold inline-flex items-center gap-2 border border-[#166534]/20 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#166534]"></span>
                    Disetujui
                </span>
            @else
                <span class="px-4 py-1 rounded-full bg-[#FEE2E2] text-[#991B1B] text-[12px] font-semibold inline-flex items-center gap-2 border border-[#991B1B]/20 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#991B1B]"></span>
                    Ditolak
                </span>
            @endif
        </div>
    </div>

    <div class="bg-surface rounded-xl shadow-sm border border-outline-variant/30 p-6 flex flex-wrap lg:flex-nowrap gap-6 items-center justify-between">
        <div class="flex-1 min-w-[150px]">
            <p class="text-[12px] font-semibold text-on-surface-variant mb-1" style="letter-spacing: 0.05em;">Total Pengajuan</p>
            <p class="text-[28px] font-bold text-primary" style="font-family: 'Plus Jakarta Sans', sans-serif;">Rp{{ number_format($pengajuan->loan_amount, 0, ',', '.') }}</p>
        </div>
        <div class="hidden lg:block w-px h-12 bg-outline-variant/30"></div>
        <div class="flex-1 min-w-[120px]">
            <p class="text-[12px] font-semibold text-on-surface-variant mb-1" style="letter-spacing: 0.05em;">Tenor</p>
            <p class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $pengajuan->tenor }} Bulan</p>
        </div>
        <div class="hidden lg:block w-px h-12 bg-outline-variant/30"></div>
        <div class="flex-1 min-w-[150px]">
            <p class="text-[12px] font-semibold text-on-surface-variant mb-1" style="letter-spacing: 0.05em;">Estimasi Cicilan</p>
            <p class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">Rp{{ number_format($pengajuan->monthly_bill, 0, ',', '.') }} <span class="text-[14px] text-on-surface-variant font-normal">/bln</span></p>
        </div>
        <div class="hidden lg:block w-px h-12 bg-outline-variant/30"></div>
        <div class="flex-1 min-w-[120px]">
            <p class="text-[12px] font-semibold text-on-surface-variant mb-1" style="letter-spacing: 0.05em;">Tanggal Pengajuan</p>
            <p class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $pengajuan->created_at->format('d M Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-surface rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden flex flex-col">
            <div class="px-6 py-4 border-b border-outline-variant/30 bg-surface-container-low/50 flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">person</span>
                <h3 class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">Informasi Nasabah</h3>
            </div>
            <div class="p-6 flex-1">
                <dl class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-3 gap-2 items-start py-2 border-b border-surface-container-high last:border-0">
                        <dt class="text-[12px] font-semibold text-on-surface-variant col-span-1 pt-1" style="letter-spacing: 0.05em;">Nama Lengkap</dt>
                        <dd class="text-[14px] text-on-surface col-span-2 font-medium">{{ $pengajuan->customer_name }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-start py-2 border-b border-surface-container-high last:border-0">
                        <dt class="text-[12px] font-semibold text-on-surface-variant col-span-1 pt-1" style="letter-spacing: 0.05em;">Tipe Pengajuan</dt>
                        <dd class="text-[14px] text-on-surface col-span-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-primary-container/20 text-primary">
                                {{ $pengajuan->loan_type_label }}
                            </span>
                        </dd>
                    </div>
                    <div class="grid grid-cols-3 gap-2 items-start py-2 border-b border-surface-container-high last:border-0">
                        <dt class="text-[12px] font-semibold text-on-surface-variant col-span-1 pt-1" style="letter-spacing: 0.05em;">Pendapatan Bulanan</dt>
                        <dd class="text-[14px] text-on-surface col-span-2 font-semibold">Rp{{ number_format($pengajuan->monthly_income, 0, ',', '.') }}</dd>
                    </div>
                    @if ($pengajuan->notes)
                        <div class="grid grid-cols-3 gap-2 items-start py-2 border-b border-surface-container-high last:border-0">
                            <dt class="text-[12px] font-semibold text-on-surface-variant col-span-1 pt-1" style="letter-spacing: 0.05em;">Catatan</dt>
                            <dd class="text-[14px] text-on-surface col-span-2 leading-relaxed">{{ $pengajuan->notes }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <div class="flex flex-col gap-6">
            <div class="bg-surface rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
                <div class="px-6 py-4 border-b border-outline-variant/30 bg-surface-container-low/50 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">request_quote</span>
                    <h3 class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">Ringkasan Kredit</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 gap-4">
                        <div class="grid grid-cols-2 gap-2 py-2 border-b border-surface-container-high last:border-0">
                            <dt class="text-[12px] font-semibold text-on-surface-variant" style="letter-spacing: 0.05em;">Nominal Pengajuan</dt>
                            <dd class="text-[14px] text-on-surface text-right font-semibold">Rp{{ number_format($pengajuan->loan_amount, 0, ',', '.') }}</dd>
                        </div>
                        <div class="grid grid-cols-2 gap-2 py-2 border-b border-surface-container-high last:border-0">
                            <dt class="text-[12px] font-semibold text-on-surface-variant" style="letter-spacing: 0.05em;">Tenor</dt>
                            <dd class="text-[14px] text-on-surface text-right">{{ $pengajuan->tenor }} Bulan</dd>
                        </div>
                        <div class="grid grid-cols-2 gap-2 py-2 border-b border-surface-container-high last:border-0">
                            <dt class="text-[12px] font-semibold text-on-surface-variant" style="letter-spacing: 0.05em;">Tagihan Per Bulan</dt>
                            <dd class="text-[14px] text-on-surface text-right font-semibold">Rp{{ number_format($pengajuan->monthly_bill, 0, ',', '.') }}</dd>
                        </div>
                        <div class="grid grid-cols-2 gap-2 py-2 border-b border-surface-container-high last:border-0">
                            <dt class="text-[12px] font-semibold text-on-surface-variant" style="letter-spacing: 0.05em;">Status</dt>
                            <dd class="text-right">
                                @if ($pengajuan->status === 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#FEF3C7] text-[#92400E]">Pending</span>
                                @elseif ($pengajuan->status === 'disetujui')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#DCFCE7] text-[#166534]">Disetujui</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#FEE2E2] text-[#991B1B]">Ditolak</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            @if ($pengajuan->isPending())
                <div class="bg-surface rounded-xl shadow-lg border border-outline-variant/20 p-4 flex flex-wrap items-center justify-between gap-4 sticky bottom-8 z-10">
                    <p class="text-[14px] text-on-surface-variant px-4">Keputusan harus dibuat untuk pengajuan ini.</p>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <a href="{{ route('pengajuan.index') }}"
                           class="flex-1 sm:flex-none px-8 py-2 rounded-lg bg-surface border border-outline text-on-surface text-[12px] font-semibold hover:bg-surface-container transition-colors shadow-sm text-center">
                            Kembali
                        </a>
                        <button type="button"
                                onclick="document.getElementById('rejectModal').classList.remove('hidden')"
                                class="flex-1 sm:flex-none px-8 py-2 rounded-lg bg-error text-on-error text-[12px] font-semibold hover:opacity-90 transition-colors shadow-sm text-center flex justify-center items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">close</span> Tolak
                        </button>
                        <button type="button"
                                onclick="document.getElementById('approveModal').classList.remove('hidden')"
                                class="flex-1 sm:flex-none px-8 py-2 rounded-lg bg-primary text-on-primary text-[12px] font-semibold hover:bg-on-primary-fixed-variant transition-colors shadow-sm text-center flex justify-center items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">check</span> Setujui
                        </button>
                    </div>
                </div>
            @else
                <div class="bg-surface rounded-xl shadow-sm border border-outline-variant/20 p-4 flex items-center justify-end">
                    <a href="{{ route('pengajuan.index') }}"
                       class="px-8 py-2 rounded-lg bg-surface border border-outline text-on-surface text-[12px] font-semibold hover:bg-surface-container transition-colors shadow-sm text-center">
                        Kembali
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<div id="approveModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-on-background/30 backdrop-blur-sm transition-opacity" onclick="document.getElementById('approveModal').classList.add('hidden')"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="relative bg-surface-container-lowest rounded-2xl w-full max-w-md shadow-lg overflow-hidden flex flex-col">
            <div class="h-2 w-full bg-primary"></div>
            <div class="p-6">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 text-primary">
                        <span class="material-symbols-outlined text-[24px]">fact_check</span>
                    </div>
                    <div class="pt-1">
                        <h2 class="text-[24px] font-semibold text-on-surface mb-1 leading-none" style="font-family: 'Plus Jakarta Sans', sans-serif;">Konfirmasi</h2>
                        <p class="text-[14px] text-on-surface-variant">Apakah Anda yakin ingin menyetujui pengajuan ini?</p>
                    </div>
                </div>
                <div class="bg-surface-container rounded-lg p-3 mb-6 border border-outline-variant/30">
                    <div class="flex justify-between items-center">
                        <span class="text-[13px] text-on-surface-variant" style="font-family: monospace;">#{{ $pengajuan->id }}</span>
                        <span class="text-[12px] font-semibold text-on-surface">Rp{{ number_format($pengajuan->loan_amount, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-[14px] text-on-surface mt-1 truncate">{{ $pengajuan->customer_name }}</p>
                </div>
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <button type="button" onclick="document.getElementById('approveModal').classList.add('hidden')"
                            class="px-4 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-[12px] font-semibold hover:bg-surface-container-low transition-colors active:scale-95 w-full sm:w-auto text-center">
                        Batal
                    </button>
                    <form method="POST" action="{{ route('pengajuan.approve', $pengajuan) }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2.5 rounded-lg bg-primary text-on-primary text-[12px] font-semibold hover:bg-on-primary-fixed-variant transition-colors active:scale-95 shadow-sm w-full sm:w-auto text-center flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[16px]">check</span>
                            Ya, Setujui
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="rejectModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-on-background/30 backdrop-blur-sm transition-opacity" onclick="document.getElementById('rejectModal').classList.add('hidden')"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="relative bg-surface-container-lowest rounded-2xl w-full max-w-md shadow-lg overflow-hidden flex flex-col">
            <div class="h-2 w-full bg-error"></div>
            <div class="p-6">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center flex-shrink-0 text-error">
                        <span class="material-symbols-outlined text-[24px]">warning</span>
                    </div>
                    <div class="pt-1">
                        <h2 class="text-[24px] font-semibold text-on-surface mb-1 leading-none" style="font-family: 'Plus Jakarta Sans', sans-serif;">Konfirmasi</h2>
                        <p class="text-[14px] text-on-surface-variant">Apakah Anda yakin ingin menolak pengajuan ini?</p>
                    </div>
                </div>
                <div class="bg-surface-container rounded-lg p-3 mb-6 border border-outline-variant/30">
                    <div class="flex justify-between items-center">
                        <span class="text-[13px] text-on-surface-variant" style="font-family: monospace;">#{{ $pengajuan->id }}</span>
                        <span class="text-[12px] font-semibold text-on-surface">Rp{{ number_format($pengajuan->loan_amount, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-[14px] text-on-surface mt-1 truncate">{{ $pengajuan->customer_name }}</p>
                </div>
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')"
                            class="px-4 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-[12px] font-semibold hover:bg-surface-container-low transition-colors active:scale-95 w-full sm:w-auto text-center">
                        Batal
                    </button>
                    <form method="POST" action="{{ route('pengajuan.reject', $pengajuan) }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2.5 rounded-lg bg-error text-on-error text-[12px] font-semibold hover:opacity-90 transition-colors active:scale-95 shadow-sm w-full sm:w-auto text-center flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                            Ya, Tolak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
