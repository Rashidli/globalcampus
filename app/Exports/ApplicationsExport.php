<?php

namespace App\Exports;

use App\Models\Program;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class ApplicationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
            'user', 'user.agent.agent_info', 'user.student_info',
            'tariff.profession', 'university_list', 'education_level',
            'period', 'program_status'
        ])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Ad Soyad',
            'Başvuru İxtisası',
            'Universitet',
            'Proqram',
            'Dönəm',
            'Agent',
            'Menecer',
            'Status',
            'Passport No',
            'App No',
            'Başvuru Tarixi',
        ];
    }

    /**
     * @param Program $application
     * @return array
     */
    public function map($application): array
    {
        return [
            $application->user?->name . ' ' . $application->user?->surname,
            $application->tariff?->profession->title ?? 'N/A',
            $application->university_list?->title ?? 'N/A',
            $application->education_level?->title ?? 'N/A',
            $application->period?->title ?? 'N/A',
            $application->user?->agent?->agent_info?->company_name ?? 'N/A',
            $application->user?->user?->name ?? 'N/A',
            $application->program_status?->title ?? 'N/A',
            $application->user?->student_info?->passport_number ?? 'N/A',
            $application->app_no ?? 'N/A',
            $application->application_date ?? 'N/A',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Başlıqları qalın et
            'A1:Z1' => ['fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'DDDDDD']]], // Açıq boz fon rəngi
            'A:Z' => ['alignment' => ['horizontal' => 'center']], // Mərkəzə düzləndirilmiş mətn
        ];
    }
}
