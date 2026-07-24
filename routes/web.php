<?php

use App\Http\Controllers\PengajuanController;
use App\Models\Pengajuan;
use App\Services\PengajuanService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $service = app(PengajuanService::class);
    $stats = $service->getDashboardStats();
    $latestPengajuan = $service->getLatestPengajuan(5);
    $chartData = $service->getChart_data();

    return view('dashboard', compact('stats', 'latestPengajuan', 'chartData'));
})->name('dashboard');

Route::resource('pengajuan', PengajuanController::class)->except(['edit', 'update', 'destroy']);

Route::post('pengajuan/{pengajuan}/approve', [PengajuanController::class, 'approve'])
    ->name('pengajuan.approve');

Route::post('pengajuan/{pengajuan}/reject', [PengajuanController::class, 'reject'])
    ->name('pengajuan.reject');
