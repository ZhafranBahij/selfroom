<?php

namespace App\Imports;

use App\Models\Journal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class JournalImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (empty($row['title'])) {
            return null;
        }

        return new Journal([
            'title' => $row['title'],
            'date' => $this->parseDate($row['date'] ?? null),
            'description' => $row['description'] ?? null,
        ]);
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * Parse the date from Excel format to Y-m-d H:i:s
     *
     * @param mixed $date
     * @return string
     */
    private function parseDate($date)
    {
        if (empty($date)) {
            return now();
        }

        try {
            // Try to parse the date if it's a string
            if (is_string($date)) {
                return Carbon::parse($date)->format('Y-m-d H:i:s');
            }
            
            // If it's a numeric value (Excel timestamp), convert it
            if (is_numeric($date)) {
                return Carbon::createFromTimestamp((int) (($date - 25569) * 86400))->format('Y-m-d H:i:s');
            }
            
            return now();
        } catch (\Exception $e) {
            return now();
        }
    }
}