<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assistants;
use App\Models\Events;
use App\Models\Categories;
use App\Models\Hotels;
use App\Models\Discounts;
use App\Models\Reservations;
use App\Models\RoomsByHotels;

class MenuController extends Controller
{
    public function resumen()
    {
        try {
            $assistants =  Assistants::count();
            $events = Events::where('estatus', 1)->count();
            $categories = Categories::where('estatus', 1)->count();
            $hotels = Hotels::where('estatus', 1)->count();
            $discounts = Discounts::where('estatus', 1)->count();
            $reservations = Reservations::where('estatus', 1)->count();
            $roomsByHotels = RoomsByHotels::where('estatus', 1)->count();

            $data = [
                "assistants" => $assistants,
                "events" => $events,
                "categories" => $categories,
                "hotels" => $hotels,
                "discounts" => $discounts,
                "reservations" => $reservations,
                "rooms_by_hotels" => $roomsByHotels,
            ];

            return response()->json([
                "result" => true,
                "data" => $data,
                "message" => 'Datos obtenidos con éxito'
            ], 200);

        }catch(\Exception $e) {
            return response()->json([
                "result" => false,
                "message" => 'Error al obtener datos' . $e->getMessage()
            ], 200);
        }
        
    }
}
