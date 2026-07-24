<?php

namespace Database\Factories;

use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengajuanFactory extends Factory
{
    protected $model = Pengajuan::class;

    public function definition(): array
    {
        $loanType = $this->faker->randomElement(array_keys(Pengajuan::LOAN_TYPES));
        $tenor = $this->faker->randomElement([6, 12, 18, 24]);

        $loanAmounts = [
            'sepeda_motor' => $this->faker->numberBetween(5_000_000, 30_000_000),
            'mobil' => $this->faker->numberBetween(50_000_000, 200_000_000),
            'multiguna' => $this->faker->numberBetween(10_000_000, 100_000_000),
        ];

        return [
            'customer_name' => $this->faker->name(),
            'loan_type' => $loanType,
            'loan_amount' => $loanAmounts[$loanType],
            'tenor' => $tenor,
            'monthly_income' => $this->faker->numberBetween(2_000_000, 15_000_000),
            'notes' => $this->faker->optional(0.4)->sentence(),
            'status' => 'pending',
            'created_at' => $this->faker->dateTimeBetween('-60 days', 'now'),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => ['status' => 'pending']);
    }

    public function disetujui(): static
    {
        return $this->state(fn () => ['status' => 'disetujui']);
    }

    public function ditolak(): static
    {
        return $this->state(fn () => ['status' => 'ditolak']);
    }
}
