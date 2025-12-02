<?php

namespace App\Imports;

use App\Models\Account;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class TransactionImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Find or create accounts
        $fromAccount = $this->findOrCreateAccount($row['from_account'] ?? $row['from account'] ?? null);
        $toAccount = $this->findOrCreateAccount($row['to_account'] ?? $row['to account'] ?? null);

        return new Transaction([
            'from_id' => $fromAccount->id,
            'to_id' => $toAccount->id,
            'amount' => $row['amount'] ?? 0,
            'date' => $row['date'] ?? now(),
            'description' => $row['description'] ?? null,
        ]);
    }

    private function findOrCreateAccount($accountName)
    {
        if (empty($accountName)) {
            throw new \Exception('Account name is required');
        }

        return Account::firstOrCreate(
            ['name' => $accountName],
        );
    }

    public function rules(): array
    {
        return [
            'from_account' => 'required|string|max:255',
            'to_account' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            'from_account' => 'from account',
            'to_account' => 'to account',
        ];
    }
}
