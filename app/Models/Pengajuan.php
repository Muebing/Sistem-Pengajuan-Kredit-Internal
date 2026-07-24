<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'customer_name',
        'loan_type',
        'loan_amount',
        'tenor',
        'monthly_income',
        'notes',
        'status',
    ];

    protected $casts = [
        'loan_amount' => 'decimal:2',
        'monthly_income' => 'decimal:2',
        'tenor' => 'integer',
    ];

    public const LOAN_TYPES = [
        'sepeda_motor' => 'Sepeda Motor',
        'mobil' => 'Mobil',
        'multiguna' => 'Multiguna',
    ];

    public const STATUSES = [
        'pending' => 'Pending',
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_DISETUJUI = 'disetujui';
    public const STATUS_DITOLAK = 'ditolak';

    public const MAX_MONTHLY_INCOME = 1_000_000;
    public const MAX_LOAN_AMOUNT = 200_000_000;
    public const MAX_TENOR = 24;
    public const MAX_APPLICATIONS_PER_CUSTOMER = 3;

    public function getLoanTypeLabelAttribute(): string
    {
        return self::LOAN_TYPES[$this->loan_type] ?? $this->loan_type;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getMonthlyBillAttribute(): float
    {
        return $this->loan_amount / $this->tenor;
    }

    public function scopeSearchByCustomer($query, ?string $search)
    {
        if ($search) {
            $query->where('customer_name', 'like', "%{$search}%");
        }

        return $query;
    }

    public function scopeFilterByStatus($query, ?string $status)
    {
        if ($status && array_key_exists($status, self::STATUSES)) {
            $query->where('status', $status);
        }

        return $query;
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }
}
