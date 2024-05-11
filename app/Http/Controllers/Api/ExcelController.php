<?php

namespace App\Http\Controllers\Api;

use App\Exports\ReportRoomingListExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Reservations;

class ExcelController extends Controller
{
    public function exportRoomingList(Request $request)
    {
        $request->validate([
            'evento_id' => 'required',
            'hotel_id' => 'required',
            'tipo_plan_id' => 'required',
            'estatus_pago_id' => 'required'
        ], [
            'evento_id.required' => 'El evento es requerido',
            'hotel_id.required' => 'El hotel es requerido',
            'tipo_plan_id.required' => 'El tipo de plan es requerido',
            'estatus_pago_id.required' => 'El estatus de pago es requerido'
        ]);

        $evento_id = $request->input('evento_id');
        $hotel_id = $request->input('hotel_id');
        $tipo_plan_id = $request->input('tipo_plan_id');
        $estatus_pago_id = $request->input('estatus_pago_id');
 
        $reservationsQuery = Reservations::where('event_id', $evento_id)
            ->where('hotel_id', $hotel_id)
            ->where('plan_id', $tipo_plan_id)
            ->with(['reservationRooms.reservationRoomsDetails', 'reservationDetails']);

        //validamos el estatus 4: significa sin estatus todos los registros
        if($estatus_pago_id != 4) {
            $reservationsQuery->where('estatus', $estatus_pago_id);
        }

        $reservations = $reservationsQuery->get();

        return Excel::download(new ReportRoomingListExport($reservations), 'rooming-list.xlsx');
    }
}
