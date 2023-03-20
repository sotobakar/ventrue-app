<?php

namespace App\Exports;

use App\Models\EventFeedback;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventFeedbacksExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    private Collection $feedbacks;

    public function __construct($feedbacks)
    {
        $this->feedbacks = $feedbacks;
    }

    public function headings(): array
    {
        return [
            'Rating',
            'Pesan',
        ];
    }

    /**
     * @var EventFeedback $feedback
     */
    public function map($feedback): array
    {
        return [
            $feedback->rating,
            $feedback->body,
        ];
    }

    public function collection()
    {
        return $this->feedbacks;
    }
}
