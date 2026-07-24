<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanRequest;
use App\Models\Pengajuan;
use App\Services\PengajuanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    public function __construct(
        private readonly PengajuanService $pengajuanService,
    ) {}

    public function index(Request $request): View
    {
        $search = $request->input('search', '');
        $status = $request->input('status');

        $pengajuans = $this->pengajuanService->getList($search, $status);

        return view('pengajuan.index', compact('pengajuans', 'search', 'status'));
    }

    public function create(): View
    {
        return view('pengajuan.create');
    }

    public function store(StorePengajuanRequest $request): RedirectResponse
    {
        $this->pengajuanService->create($request->validated());

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan kredit berhasil disimpan.');
    }

    public function show(Pengajuan $pengajuan): View
    {
        return view('pengajuan.show', compact('pengajuan'));
    }

    public function approve(Pengajuan $pengajuan): RedirectResponse
    {
        $this->pengajuanService->approve($pengajuan);

        return redirect()
            ->route('pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Pengajuan $pengajuan): RedirectResponse
    {
        $this->pengajuanService->reject($pengajuan);

        return redirect()
            ->route('pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}
