<?php

namespace App\Services;

use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;

class PengajuanService
{
    public function getDashboardStats(): array
    {
        return [
            'total' => Pengajuan::count(),
            'pending' => Pengajuan::where('status', Pengajuan::STATUS_PENDING)->count(),
            'disetujui' => Pengajuan::where('status', Pengajuan::STATUS_DISETUJUI)->count(),
            'ditolak' => Pengajuan::where('status', Pengajuan::STATUS_DITOLAK)->count(),
        ];
    }

    public function getLatestPengajuan(int $limit = 5)
    {
        return Pengajuan::latest()->take($limit)->get();
    }

    public function getChart_data(): array
    {
        $days = 30;
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->format('d M');
            $total = Pengajuan::whereDate('created_at', $date)->count();
            $pending = Pengajuan::whereDate('created_at', $date)->where('status', Pengajuan::STATUS_PENDING)->count();
            $disetujui = Pengajuan::whereDate('created_at', $date)->where('status', Pengajuan::STATUS_DISETUJUI)->count();
            $ditolak = Pengajuan::whereDate('created_at', $date)->where('status', Pengajuan::STATUS_DITOLAK)->count();

            $data[] = [
                'label' => $label,
                'total' => $total,
                'pending' => $pending,
                'disetujui' => $disetujui,
                'ditolak' => $ditolak,
            ];
        }

        return $data;
    }

    public function getList(?string $search = null, ?string $status = null)
    {
        return Pengajuan::query()
            ->searchByCustomer($search)
            ->filterByStatus($status)
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function create(array $data): Pengajuan
    {
        $this->validateMaxApplications($data['customer_name']);

        return Pengajuan::create($data);
    }

    public function approve(Pengajuan $pengajuan): void
    {
        $this->validatePendingStatus($pengajuan);
        $this->validateMaxLoanAmount($pengajuan);

        $pengajuan->update(['status' => Pengajuan::STATUS_DISETUJUI]);
    }

    public function reject(Pengajuan $pengajuan): void
    {
        $this->validatePendingStatus($pengajuan);

        $pengajuan->update(['status' => Pengajuan::STATUS_DITOLAK]);
    }

    private function validateMaxApplications(string $customerName): void
    {
        $count = Pengajuan::where('customer_name', $customerName)->count();

        if ($count >= Pengajuan::MAX_APPLICATIONS_PER_CUSTOMER) {
            abort(422, 'Nasabah telah memiliki maksimal 3 pengajuan.');
        }
    }

    private function validatePendingStatus(Pengajuan $pengajuan): void
    {
        if (!$pengajuan->isPending()) {
            abort(422, 'Pengajuan ini sudah tidak dalam status pending.');
        }
    }

    private function validateMaxLoanAmount(Pengajuan $pengajuan): void
    {
        if ($pengajuan->loan_amount > Pengajuan::MAX_LOAN_AMOUNT) {
            abort(422, 'Nominal pinjaman melebihi batas persetujuan.');
        }
    }
}
