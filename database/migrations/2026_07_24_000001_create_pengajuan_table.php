<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->enum('loan_type', ['sepeda_motor', 'mobil', 'multiguna']);
            $table->decimal('loan_amount', 15, 2);
            $table->unsignedSmallInteger('tenor');
            $table->decimal('monthly_income', 15, 2);
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
