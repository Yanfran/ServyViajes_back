<?php
namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Reservations;

class ReportRoomingListExport implements FromView
{
    protected $reservations;

    public function __construct($reservations)
    {
        $this->reservations = $reservations;
    }

    public function view(): View
    {
        return view('exports.report-rooming-list', [
            'reservations' => $this->reservations
        ]);
    }
}