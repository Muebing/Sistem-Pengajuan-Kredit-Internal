@extends('layouts.app')

@section('title', 'Daftar Pengajuan - Capella Multidana')
@section('header', 'Daftar Pengajuan')

@section('content')
<div class="flex flex-col gap-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-surface p-4 rounded-xl border border-outline-variant shadow-sm">
        <form method="GET" action="{{ route('pengajuan.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:flex-none md:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari nama nasabah..."
                       class="w-full pl-10 pr-3 py-2 rounded-lg border border-outline-variant bg-surface text-on-surface text-[14px] focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none">
            </div>
            <select name="status"
                    class="rounded-lg border border-outline-variant bg-surface text-on-surface text-[14px] py-2 px-3 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                <option value="">Semua Status</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ $status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ $status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit"
                    class="bg-primary text-on-primary hover:bg-on-primary-fixed-variant transition-colors rounded-lg py-2 px-4 text-[12px] font-semibold flex items-center justify-center gap-1 shadow-sm whitespace-nowrap active:scale-95">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filter
            </button>
            @if ($search || $status)
                <a href="{{ route('pengajuan.index') }}"
                   class="rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface py-2 px-4 text-[12px] font-semibold hover:bg-surface-container-low transition-colors active:scale-95 whitespace-nowrap">
                    Reset
                </a>
            @endif
        </form>
        <a href="{{ route('pengajuan.create') }}"
           class="bg-primary-container text-on-primary-container hover:brightness-95 transition-colors rounded-lg py-2 px-4 text-[12px] font-semibold flex items-center justify-center gap-1 shadow-sm whitespace-nowrap active:scale-95">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Tambah Pengajuan
        </a>
    </div>

    <div class="bg-surface rounded-xl border border-outline-variant shadow-sm overflow-hidden flex-1 flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-surface-container-low border-b border-outline-variant">
                    <tr>
                        <th class="py-2 px-4 text-[12px] font-semibold text-on-surface-variant whitespace-nowrap" style="letter-spacing: 0.05em;">Nama Nasabah</th>
                        <th class="py-2 px-4 text-[12px] font-semibold text-on-surface-variant whitespace-nowrap" style="letter-spacing: 0.05em;">Tipe Pengajuan</th>
                        <th class="py-2 px-4 text-[12px] font-semibold text-on-surface-variant whitespace-nowrap text-right" style="letter-spacing: 0.05em;">Nominal</th>
                        <th class="py-2 px-4 text-[12px] font-semibold text-on-surface-variant whitespace-nowrap text-right" style="letter-spacing: 0.05em;">Tenor</th>
                        <th class="py-2 px-4 text-[12px] font-semibold text-on-surface-variant whitespace-nowrap text-right" style="letter-spacing: 0.05em;">Tagihan/Bulan</th>
                        <th class="py-2 px-4 text-[12px] font-semibold text-on-surface-variant whitespace-nowrap" style="letter-spacing: 0.05em;">Tanggal</th>
                        <th class="py-2 px-4 text-[12px] font-semibold text-on-surface-variant whitespace-nowrap" style="letter-spacing: 0.05em;">Status</th>
                        <th class="py-2 px-4 text-[12px] font-semibold text-on-surface-variant whitespace-nowrap text-center" style="letter-spacing: 0.05em;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[14px]">
                    @forelse ($pengajuans as $pengajuan)
                        <tr class="border-b border-surface-container-highest hover:bg-surface-container-lowest transition-colors h-[52px]">
                            <td class="py-1 px-4 font-medium text-on-surface">{{ $pengajuan->customer_name }}</td>
                            <td class="py-1 px-4 text-on-surface-variant">{{ $pengajuan->loan_type_label }}</td>
                            <td class="py-1 px-4 text-right text-[13px]" style="font-family: monospace;">Rp{{ number_format($pengajuan->loan_amount, 0, ',', '.') }}</td>
                            <td class="py-1 px-4 text-right">{{ $pengajuan->tenor }} Bulan</td>
                            <td class="py-1 px-4 text-right text-[13px]" style="font-family: monospace;">Rp{{ number_format($pengajuan->monthly_bill, 0, ',', '.') }}</td>
                            <td class="py-1 px-4 text-on-surface-variant">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td class="py-1 px-4">
                                @if ($pengajuan->status === 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#FEF3C7] text-[#92400E]">Pending</span>
                                @elseif ($pengajuan->status === 'disetujui')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#DCFCE7] text-[#166534]">Disetujui</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#FEE2E2] text-[#991B1B]">Ditolak</span>
                                @endif
                            </td>
                            <td class="py-1 px-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('pengajuan.show', $pengajuan) }}"
                                       class="p-1 text-on-surface-variant hover:text-primary transition-colors rounded hover:bg-surface-container-low"
                                       title="Detail">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    </a>
                                    @if ($pengajuan->isPending())
                                        <button type="button"
                                                onclick="openApproveModal({{ $pengajuan->id }}, '{{ $pengajuan->customer_name }}')"
                                                class="p-1 text-on-surface-variant hover:text-[#166534] transition-colors rounded hover:bg-[#DCFCE7]"
                                                title="Setujui">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        </button>
                                        <button type="button"
                                                onclick="openRejectModal({{ $pengajuan->id }}, '{{ $pengajuan->customer_name }}')"
                                                class="p-1 text-on-surface-variant hover:text-[#991B1B] transition-colors rounded hover:bg-[#FEE2E2]"
                                                title="Tolak">
                                            <span class="material-symbols-outlined text-[18px]">cancel</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="material-symbols-outlined text-[48px] text-outline-variant">folder_open</span>
                                    <p class="mt-3 text-[14px] text-on-surface-variant">Tidak ada data pengajuan ditemukan.</p>
                                    <a href="{{ route('pengajuan.create') }}" class="mt-4 text-[12px] font-semibold text-primary hover:underline">
                                        Tambah pengajuan baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengajuans->hasPages())
            <div class="mt-auto p-4 border-t border-outline-variant flex items-center justify-between bg-surface-container-low">
                <span class="text-[14px] text-on-surface-variant">
                    Menampilkan {{ $pengajuans->firstItem() }}-{{ $pengajuans->lastItem() }} dari {{ $pengajuans->total() }} data
                </span>
                <div class="flex gap-1">
                    @if ($pengajuans->onFirstPage())
                        <button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant bg-surface text-on-surface-variant opacity-50" disabled>
                            <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                        </button>
                    @else
                        <a href="{{ $pengajuans->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant bg-surface text-on-surface-variant hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                        </a>
                    @endif

                    @foreach ($pengajuans->getUrlRange(max(1, $pengajuans->currentPage() - 1), min($pengajuans->lastPage(), $pengajuans->currentPage() + 1)) as $page => $url)
                        <a href="{{ $url }}"
                           class="w-8 h-8 flex items-center justify-center rounded border {{ $page === $pengajuans->currentPage() ? 'border-primary bg-primary-container text-on-primary-container font-semibold' : 'border-outline-variant bg-surface text-on-surface hover:bg-surface-container-high' }} transition-colors text-[12px]">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if ($pengajuans->hasMorePages())
                        <a href="{{ $pengajuans->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant bg-surface text-on-surface-variant hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    @else
                        <button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant bg-surface text-on-surface-variant opacity-50" disabled>
                            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<div id="approveModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-on-background/30 backdrop-blur-sm transition-opacity" onclick="closeApproveModal()"></div>
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
                        <p class="text-[14px] text-on-surface-variant" id="approveText"></p>
                    </div>
                </div>
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-6">
                    <button type="button" onclick="closeApproveModal()"
                            class="px-4 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-[12px] font-semibold hover:bg-surface-container-low transition-colors active:scale-95 w-full sm:w-auto text-center">
                        Batal
                    </button>
                    <form id="approveForm" method="POST" class="inline">
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
    <div class="absolute inset-0 bg-on-background/30 backdrop-blur-sm transition-opacity" onclick="closeRejectModal()"></div>
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
                        <p class="text-[14px] text-on-surface-variant" id="rejectText"></p>
                    </div>
                </div>
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-6">
                    <button type="button" onclick="closeRejectModal()"
                            class="px-4 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface text-[12px] font-semibold hover:bg-surface-container-low transition-colors active:scale-95 w-full sm:w-auto text-center">
                        Batal
                    </button>
                    <form id="rejectForm" method="POST" class="inline">
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

@push('scripts')
<script>
    function openApproveModal(id, name) {
        document.getElementById('approveText').textContent = 'Apakah Anda yakin ingin menyetujui pengajuan ' + name + '?';
        document.getElementById('approveForm').action = '/pengajuan/' + id + '/approve';
        document.getElementById('approveModal').classList.remove('hidden');
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
    }

    function openRejectModal(id, name) {
        document.getElementById('rejectText').textContent = 'Apakah Anda yakin ingin menolak pengajuan ' + name + '?';
        document.getElementById('rejectForm').action = '/pengajuan/' + id + '/reject';
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }
</script>
@endpush
@endsection
