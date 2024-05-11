<table>
    <thead>
    <tr>
        <th style="font-weight: bold; width: 136px">Clave de reservación</th>
        <th style="font-weight: bold; width: 122px">Tipo de habitación</th>
        <th style="font-weight: bold; width: 120px">Titular</th>
        <th style="font-weight: bold; width: 120px">Acompañante 1</th>
        <th style="font-weight: bold; width: 120px">Acompañante 2</th>
        <th style="font-weight: bold; width: 120px">Acompañante 3</th>
        <th style="font-weight: bold; width: 120px">Menor 1</th>
        <th style="font-weight: bold; width: 120px">Menor 2</th>
        <th style="font-weight: bold; width: 120px">Menor 3</th>
        <th style="font-weight: bold; width: 91px">Edad menor 1</th>
        <th style="font-weight: bold; width: 91px">Edad menor 2</th>
        <th style="font-weight: bold; width: 91px">Edad menor 3</th>
        <th style="font-weight: bold; width: 73px">IN</th>
        <th style="font-weight: bold; width: 73px">OUT</th>
        <th style="font-weight: bold; width: 104px">Total de noches</th>
        <th style="font-weight: bold; width: 77px">Estatus</th>
        <th style="font-weight: bold; width: 77px">Monto</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reservations as $reservation)
        @foreach($reservation->reservationRooms as $room)
            <tr>
                <td>{{ $reservation->clave_reservation ?? 'No disponible' }}</td>
                <td>{{ $room->room_type_name }}</td>
                <!-- titular --->
                @php
                    $idAdultoUno = 0;
                    $idAdultoDos = 0;
                    $idAdultoTres = 0;
                @endphp

                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type == 'adult')
                            @php
                                $idAdultoUno = $room_detail->id;
                            @endphp
                            {{ $room_detail->name }} {{ $room_detail->last_name }}
                            @break
                        @endif
                    @endforeach
                </td>
                <!-- Acompañante 1 --->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type == 'adult' && $room_detail->id != $idAdultoUno)
                            @php
                                $idAdultoDos = $room_detail->id;
                            @endphp
                            {{ $room_detail->name }} {{ $room_detail->last_name }}
                            @break
                        @endif
                    @endforeach
                </td>
                <!-- Acompañante 2 --->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type == 'adult' && $room_detail->id != $idAdultoUno && $room_detail->id != $idAdultoDos)
                            @php
                                $idAdultoTres = $room_detail->id;
                            @endphp
                            {{ $room_detail->name }} {{ $room_detail->last_name }}
                            @break
                        @endif
                    @endforeach
                </td>
                <!-- Acompañante 3 --->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type == 'adult' && 
                            $room_detail->id != $idAdultoUno && 
                            $room_detail->id != $idAdultoDos && 
                            $room_detail->id != $idAdultoTres)
                            {{ $room_detail->name }} {{ $room_detail->last_name }}
                            @break
                        @endif
                    @endforeach
                </td>

                @php
                    $idMenorUno = 0;
                    $idMenorDos = 0;
                    $idMenorTres = 0;
                @endphp

                <!-- Menor 1 --->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type != 'adult')
                            @php 
                                $idMenorUno = $room_detail->id;
                            @endphp
                            {{ $room_detail->name }} {{ $room_detail->last_name }}
                            @break
                        @endif
                    @endforeach
                </td>
                <!-- Menor 2 --->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type != 'adult' && $room_detail->id != $idMenorUno)
                            @php
                                $idMenorDos = $room_detail->id;
                            @endphp
                            {{ $room_detail->name }} {{ $room_detail->last_name }}
                            @break
                        @endif
                    @endforeach
                </td>
                <!-- Menor 3 --->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type != 'adult' && $room_detail->id != $idMenorUno && $room_detail->id != $idMenorDos)
                            {{ $room_detail->name }} {{ $room_detail->last_name }}
                            @break
                        @endif
                    @endforeach
                </td>
                <!-- Edad menor 1-->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type != 'adult')
                            {{ $room_detail->age }}
                            @break
                        @endif
                    @endforeach
                </td>
                <!-- Edad menor 2-->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type != 'adult' && $room_detail->id != $idMenorUno)
                            {{ $room_detail->age }}
                            @break
                        @endif
                    @endforeach
                </td>
                <!-- Edad menor 1-->
                <td>
                    @foreach($room->reservationRoomsDetails as $room_detail)
                        @if($room_detail->type != 'adult' && $room_detail->id != $idMenorUno && $room_detail->id != $idMenorDos)
                            {{ $room_detail->age }}
                            @break
                        @endif
                    @endforeach
                </td>

                <td>{{ $reservation->fecha_entrada ? date('d-m-Y', strtotime($reservation->fecha_entrada)) : 'Fecha no disponible' }}</td>
                <td>{{ $reservation->fecha_salida ? date('d-m-Y', strtotime($reservation->fecha_salida)) : 'Fecha no disponible' }}</td>
                <td>{{ $reservation->cantidad_noches }}</td>
                <td>
                    @if($reservation->estatus == 0)
                        Reservado
                    @elseif($reservation->estatus == 1)
                        Acreditado
                    @elseif($reservation->estatus == 2)
                        Pendiente
                    @elseif($reservation->estatus == 3)
                        Pagado
                    @else
                        No definido
                    @endif
                </td>

                <!-- Agregando la columna monto -->
                <td>
                    @foreach($reservation->reservationDetails as $reservation_detail)
                        @if($loop->first && $reservation_detail->concept != 'menores')
                            {{ $reservation_detail->price }}
                            @break
                        @endif
                    @endforeach
                </td>

            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>