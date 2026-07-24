@extends('layouts.app')

@section('title', 'Tambah Pengajuan - Capella Multidana')
@section('header', 'Tambah Pengajuan')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="mb-6">
            <h2 class="text-[36px] font-bold text-on-surface mb-1"
                style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 44px; letter-spacing: -0.02em;">Tambah
                Pengajuan</h2>
            <p class="text-[16px] text-on-surface-variant">Isi formulir di bawah ini untuk menambahkan aplikasi kredit baru.
            </p>
        </div>

        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant p-6">
            <div class="pb-4 mb-4 border-b border-outline-variant">
                <h3 class="text-[18px] font-semibold text-on-surface" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    Informasi Aplikasi</h3>
            </div>

            <form method="POST" action="{{ route('pengajuan.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-1">
                        <label for="customer_name" class="text-[12px] font-semibold text-on-surface"
                            style="letter-spacing: 0.05em;">
                            Nama Lengkap Nasabah <span class="text-error">*</span>
                        </label>
                        <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}"
                            class="w-full bg-surface-container-lowest border {{ $errors->has('customer_name') ? 'border-error' : 'border-outline-variant' }} rounded-lg px-3 py-2 text-[14px] focus:border-primary focus:ring-2 focus:ring-primary-container/50 outline-none transition-all placeholder:text-outline"
                            placeholder="Masukkan nama lengkap">
                        @error('customer_name')
                            <p class="text-[11px] text-error flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="loan_type" class="text-[12px] font-semibold text-on-surface"
                            style="letter-spacing: 0.05em;">
                            Tipe Pengajuan <span class="text-error">*</span>
                        </label>
                        <div class="relative">
                            <select id="loan_type" name="loan_type"
                                class="w-full bg-surface-container-lowest border {{ $errors->has('loan_type') ? 'border-error' : 'border-outline-variant' }} rounded-lg px-3 py-2 text-[14px] focus:border-primary focus:ring-2 focus:ring-primary-container/50 outline-none transition-all appearance-none">
                                <option disabled {{ old('loan_type') ? '' : 'selected' }}>Pilih tipe pengajuan</option>
                                <option value="sepeda_motor" {{ old('loan_type') === 'sepeda_motor' ? 'selected' : '' }}>
                                    Sepeda Motor</option>
                                <option value="mobil" {{ old('loan_type') === 'mobil' ? 'selected' : '' }}>Mobil</option>
                                <option value="multiguna" {{ old('loan_type') === 'multiguna' ? 'selected' : '' }}>Multiguna
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <span class="material-symbols-outlined text-outline">expand_more</span>
                            </div>
                        </div>
                        @error('loan_type')
                            <p class="text-[11px] text-error flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="loan_amount" class="text-[12px] font-semibold text-on-surface"
                            style="letter-spacing: 0.05em;">
                            Nominal Pengajuan <span class="text-error">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-on-surface-variant text-[14px]">Rp</span>
                            </div>
                            <input type="number" id="loan_amount" name="loan_amount" value="{{ old('loan_amount') }}"
                                class="w-full bg-surface-container-lowest border {{ $errors->has('loan_amount') ? 'border-error' : 'border-outline-variant' }} rounded-lg pl-10 pr-3 py-2 text-[14px] focus:border-primary focus:ring-2 focus:ring-primary-container/50 outline-none transition-all placeholder:text-outline"
                                placeholder="0" min="1">
                        </div>
                        @error('loan_amount')
                            <p class="text-[11px] text-error flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="tenor" class="text-[12px] font-semibold text-on-surface"
                            style="letter-spacing: 0.05em;">
                            Tenor (Bulan) <span class="text-error">*</span>
                        </label>
                        <div class="relative">
                            <select id="tenor" name="tenor"
                                class="w-full bg-surface-container-lowest border {{ $errors->has('tenor') ? 'border-error' : 'border-outline-variant' }} rounded-lg px-3 py-2 text-[14px] focus:border-primary focus:ring-2 focus:ring-primary-container/50 outline-none transition-all appearance-none">
                                <option disabled {{ old('tenor') ? '' : 'selected' }}>Pilih tenor</option>
                                @for ($i = 1; $i <= 24; $i++)
                                    <option value="{{ $i }}" {{ old('tenor') == $i ? 'selected' : '' }}>
                                        {{ $i }} Bulan</option>
                                @endfor
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <span class="material-symbols-outlined text-outline">expand_more</span>
                            </div>
                        </div>
                        @error('tenor')
                            <p class="text-[11px] text-error flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="monthly_income" class="text-[12px] font-semibold text-on-surface"
                            style="letter-spacing: 0.05em;">
                            Pendapatan Bulanan <span class="text-error">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-on-surface-variant text-[14px]">Rp</span>
                            </div>
                            <input type="number" id="monthly_income" name="monthly_income"
                                value="{{ old('monthly_income') }}"
                                class="w-full bg-surface-container-lowest border {{ $errors->has('monthly_income') ? 'border-error' : 'border-outline-variant' }} rounded-lg pl-10 pr-3 py-2 text-[14px] focus:border-primary focus:ring-2 focus:ring-primary-container/50 outline-none transition-all placeholder:text-outline"
                                placeholder="0">
                        </div>
                        @error('monthly_income')
                            <p class="text-[11px] text-error flex items-center gap-1 mt-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-1 w-full">
                    <label for="notes" class="text-[12px] font-semibold text-on-surface" style="letter-spacing: 0.05em;">
                        Catatan (Opsional)
                    </label>
                    <textarea id="notes" name="notes" rows="4"
                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2 text-[14px] focus:border-primary focus:ring-2 focus:ring-primary-container/50 outline-none transition-all placeholder:text-outline resize-y"
                        placeholder="Tambahkan catatan jika diperlukan...">{{ old('notes') }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-outline-variant mt-4">
                    <a href="{{ route('pengajuan.index') }}"
                        class="bg-surface-container-lowest text-on-surface border border-outline-variant rounded-lg px-6 py-2 text-[12px] font-semibold hover:bg-surface-container-low active:scale-95 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-primary text-on-primary rounded-lg px-6 py-2 text-[12px] font-semibold hover:bg-on-primary-fixed-variant active:scale-95 transition-all flex items-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
