<?php

namespace App\Imports;

use App\Models\Settings\Citizenship;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class CitizenshipsImport implements ToCollection
{
    /**
     * @param \Illuminate\Support\Collection $rows
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            Citizenship::create([
                'title' => $row[0],
            ]);
        }

    }

}
