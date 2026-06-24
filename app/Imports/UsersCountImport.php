<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersCountImport implements ToCollection
{
    use Importable;

    public int $count = 0;

    public function collection(Collection $rows): void {
        $this->count = $rows
            ->skip(1)
            ->filter(fn ($row) => !empty($row[0]))
            ->count();
    }
}