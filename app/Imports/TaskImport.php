<?php

namespace App\Imports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TaskImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Task([
            'title' => $row['title'] ?? $row['Title'] ?? null,
            'description' => $row['description'] ?? $row['Description'] ?? null,
            'date' => $row['date'] ?? $row['Date'] ?? now(),
            'type' => strtolower($row['type'] ?? $row['Type'] ?? 'daily'),
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'type' => 'required|in:daily,weekly,monthly',
        ];
    }
}
