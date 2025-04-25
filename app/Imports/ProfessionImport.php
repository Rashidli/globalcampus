<?php

namespace App\Imports;

use App\Models\Settings\Profession;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProfessionImport implements ToCollection
{

    protected int $education_level_id;

    public function __construct($education_level_id)
    {
        $this->education_level_id = $education_level_id;
    }

    public function collection(Collection $rows){
        foreach ($rows as $row){
            Profession::create([
                'title' => $row[0],
                'education_level_id' => $this->education_level_id,
            ]);
        }
    }

}
