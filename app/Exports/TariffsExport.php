<?php

namespace App\Exports;

use App\Models\Tariff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class TariffsExport implements FromCollection, WithHeadings, WithMapping,WithStyles
{
    use Exportable;

    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->query->with([
            'school_type', 'education_level', 'education_language', 'profession', 'university_list', 'country', 'currency'
        ])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
//            'ID',
            'University',
            'School Type',
            'Education Level',
            'Education Language',
            'Profession',
            'Town',
            'Country',
            'Price',
            'Currency'
        ];
    }

    /**
     * @param Tariff $tariff
     * @return array
     */
    public function map($tariff): array
    {
        return [
//            $tariff->id,
            $tariff->university_list->title ?? 'N/A',
            $tariff->school_type->title ?? 'N/A',
            $tariff->education_level->title ?? 'N/A',
            $tariff->education_language->title ?? 'N/A',
            $tariff->profession->title ?? 'N/A',
            $tariff->town->title ?? 'N/A',
            $tariff->country->title ?? 'N/A',
            $tariff->price ?? 'N/A',
            $tariff->currency->title ?? 'N/A'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Make the first row (headings) bold
            'A1:Z1' => ['fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'DDDDDD']]], // Light gray background
            'A:Z' => ['alignment' => ['horizontal' => 'center']], // Center align all text
        ];
    }
}
