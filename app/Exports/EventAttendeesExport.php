<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventAttendeesExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    private Collection $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'Tahun Angkatan',
            'Fakultas',
            'Nomor Telepon',
            'Email',
        ];
    }

    /**
     * @var Student $student
     */
    public function map($student): array
    {
        return [
            $student->name,
            $student->sid,
            $student->year,
            $student->faculty->name,
            $student->phone,
            $student->user->email,
        ];
    }

    public function collection()
    {
        return $this->students;
    }
}
