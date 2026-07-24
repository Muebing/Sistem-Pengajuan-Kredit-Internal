<?php

namespace App\Http\Requests;

use App\Models\Pengajuan;
use Illuminate\Foundation\Http\FormRequest;

class StorePengajuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'loan_type' => ['required', 'in:sepeda_motor,mobil,multiguna'],
            'loan_amount' => ['required', 'numeric', 'min:1', 'max:' . Pengajuan::MAX_LOAN_AMOUNT],
            'tenor' => ['required', 'integer', 'min:1', 'max:' . Pengajuan::MAX_TENOR],
            'monthly_income' => ['required', 'numeric', 'min:' . Pengajuan::MAX_MONTHLY_INCOME],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Nama lengkap nasabah wajib diisi.',
            'customer_name.string' => 'Nama lengkap harus berupa teks.',
            'customer_name.max' => 'Nama lengkap maksimal 255 karakter.',
            'loan_type.required' => 'Tipe pengajuan wajib dipilih.',
            'loan_type.in' => 'Tipe pengajuan tidak valid.',
            'loan_amount.required' => 'Nominal pengajuan wajib diisi.',
            'loan_amount.numeric' => 'Nominal pengajuan harus berupa angka.',
            'loan_amount.min' => 'Nominal pengajuan minimal Rp1.',
            'loan_amount.max' => 'Nominal pinjaman maksimal Rp200.000.000.',
            'tenor.required' => 'Tenor wajib diisi.',
            'tenor.integer' => 'Tenor harus berupa angka bulat.',
            'tenor.min' => 'Tenor minimal 1 bulan.',
            'tenor.max' => 'Tenor maksimal 24 bulan.',
            'monthly_income.required' => 'Pendapatan bulanan wajib diisi.',
            'monthly_income.numeric' => 'Pendapatan bulanan harus berupa angka.',
            'monthly_income.min' => 'Nasabah belum dapat mengajukan pinjaman.',
            'notes.string' => 'Catatan harus berupa teks.',
        ];
    }
}
