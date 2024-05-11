<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template Mail</title>
    <!-- clases css -->
    <style>
        .container-body {
            margin: 0;
            padding: 0;
            padding-top: 20px;
            background-color: #99b4b6;
            font-family: Montserrat,arial,helvetica,sans-serif;
        }
        .container-email {
            margin: 0 auto;
            background-color: white;
            padding-top: 0px;
            padding-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container-logo {
            text-align: center;
            padding: 20px;
        }
        .container-logo img {
            width: 200px;
            height: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .container-detail-user {
            text-align: center;
            padding: 20px
        }
        .name-user {
            font-weight: bold;
            font-size: 20px;
            color: #000;
            margin: 10px;
        }
        .text-evento {
            font-size: 18px;
            color: #000;
        }
        .container-contact {
            text-align: center;
            padding: 20px;
        }
        .text-contact {
            color: #3b3f44;
            font-size: 16px;
        }
        .button-contact {
            background-color: #E9F5F7;
            font-size: 16px;
            color: #000000;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 30px;
            padding-right: 30px;
            font-weight: bold;
            border: #E9F5F7;
            border-radius: 15px;
            cursor: pointer;
        }
        .container-detail-event {
            background-color: #5ab9ac;
            padding: 20px;
        }
        .container-detail-pay {
            text-align: center;
            padding: 20px;
        }
        .text-detail-event {
            font-weight: 400;
            font-size: 16px;
            color: #fff;
            margin: 4px;
        }
        .table-event {
            width: 100%;
        }
        .text-access-1 {
            color: #3b3f44;
            font-size: 16px;
        }
        .text-access {
            color: #3b3f44;
            font-size: 16px;
            margin: 4px;
        }
        .access {
            color: #3b3f44;
            font-size: 16px;
            font-weight: bold;
        }
        .container-access {
            text-align: left;
            margin: 0 auto;
        }
        .container-detail-pay .title {
            color: #000;
            font-size: 18px;
            font-weight: bold;
        }
        .container-button-contact {
            padding: 10px;
        }
        .container-title-email {
            background-color: #5ab9ac;
            padding: 20px;
            text-align: center;
        }
        .container-title-email h3 {
            color: white;
            font-weight: bold;
            font-size: 24px;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .container-detail-reservation {
            padding: 20px;
        }
        .container-detail-reservation h3 {
            text-align: center;
            color: #000;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0px;
        }
        .container-detail-reservation table {
            text-align: left;
        }
        .container-detail-reservation table .columns {
            color: #3b3f44;
            font-size: 16px;
            font-weight: bold;
            margin-top: 4px;
            margin-bottom: 4px;
        }
        .container-detail-reservation table .values {
            color: #3b3f44;
            font-size: 16px;
            margin-top: 4px;
            margin-bottom: 4px;
            margin-left: 5%;
            width: 100%;
        }
        .container-detail-user h3{
            text-align: center;
            color: #000;
            font-size: 18px;
            font-weight: bold;
        }
        .container-detail-user table {
            text-align: left;
        }
        .container-detail-user table .columns {
            color: #3b3f44;
            font-size: 16px;
            font-weight: bold;
            margin-top: 4px;
            margin-bottom: 4px; 
        }
        .container-detail-user table .values {
            color: #3b3f44;
            font-size: 16px;
            margin-top: 4px;
            margin-bottom: 4px;
            margin-left: 5%;
        }

        .container-detail-pay table {
            text-align: left;
        }
        .container-detail-pay table .columns {
            color: #3b3f44;
            font-size: 16px;
            font-weight: bold;
            margin-top: 4px;
            margin-bottom: 4px;
        }
        .container-detail-pay table .values {
            color: #3b3f44;
            font-size: 16px;
            margin-top: 4px;
            margin-bottom: 4px;
            margin-left: 5%;
            width: 100%;
        }
        /*responsive secction*/
        /*pc, laptop*/
        @media only screen and (min-width: 1024px) {
            .container-email {
                width: 600px;
            }
        }
        /*tablets*/
        @media only screen and (min-width: 768px) and (max-width: 1023px) {
            .container-email {
                width: 60%;
            }
        }
        /*celulares*/
        @media only screen and (max-width: 767px) {
            .container-email {
                width: 80%;
            }
            .container-detail-user table tr {
                display: flex;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body class="container-body">
    <div class="container-email">
        <div class="container-title-email">
            <h3>Registro de reservación</h3>
        </div>

        <!-- seccion detalles usuario--->
        <div class="container-detail-user">
            <h5 class="name-user">Estimado(a) {{ $userName ?? '' }}</h5>
            <p class="text-access-1">
                Es un placer para nosotros compartirle los datos 
                de su registro de reservación al hotel {{ $hotelNombre ?? '' }}
            </p>
            @if($isNewUser)
                <h3>Accesos</h3>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <p class="columns">Correo electrónico: </p>
                            </td>
                            <td>
                                <p class="values">{{ $userEmail ?? '' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="columns">Contraseña: </p>
                            </td>
                            <td>
                                <p class="values">{{ $password ?? '' }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endIf
        </div>

        <!--seccion detalles de la reservacion -->
        <div class="container-detail-reservation">
            <h3>Detalles de la reservación</h3>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p class="columns">Nombre del hotel: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $hotelNombre ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Dirección: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $hotelDireccion ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Nombre del solicitante: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $userName ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Fecha de entrada: </p> 
                        </td>
                        <td>
                            <p class="values">
                                {{ $fechaEntrada ? date('d-m-Y', strtotime($fechaEntrada)) : 'no disponible' }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Fecha de salida: </p> 
                        </td>
                        <td>
                            <p class="values">
                                {{ $fechaSalida ? date('d-m-Y', strtotime($fechaSalida)) : 'no disponible' }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Noches: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $noches ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Habitaciones reservadas: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $habitacionesReservadas }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Plan: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $planNombre ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Tipos de habitaciónes: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $tiposHabitaciones ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Numero de adultos: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $adultosHabitaciones ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Numero de menores: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $menoresHabitaciones ?? 'No disponible'}}</p>
                        </td>
                    </tr>
                    {{---
                    <tr>
                        <td>
                            <p class="columns">Numero de adultos: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $numeroAdultos ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Numero de menores: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $numeroMenores ?? 'No disponible'}}</p>
                        </td>
                    </tr>
                    ----}}
                    <tr>
                        <td>
                            <p class="columns">Desglose: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $preciosHabitaciones ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Total de estancia: </p> 
                        </td>
                        <td>
                            <p class="values">${{ $montoTotalReservacion ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Saldo: </p> 
                        </td>
                        <td>
                            <p class="values">${{ $montoTotalReservacion ?? 'No disponible' }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Tiempo limite de pago: </p> 
                        </td>
                        <td>
                            <p class="values"></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- seccion detalles pago-->
        <div class="container-detail-pay">
            <h3 class="title">Datos de pago</h3>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p class="columns">Beneficiario: </p>
                        </td>
                        <td>
                            <p class="values">{{ $beneficiario ?? 'No disponible'}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Banco: </p>
                        </td>
                        <td>
                            <p class="values">{{ $banco ?? 'No disponible'}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">Numero de cuenta: </p> 
                        </td>
                        <td>
                            <p class="values">{{ $numero_cuenta ?? 'No disponible'}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="columns">CLABE interbancaria: </p>
                        </td>
                        <td>
                            <p class="values">{{ $clabe_interbancaria ?? 'No disponible'}}</p>
                        </td>
                    </tr>             
                </tbody>
            </table>
        </div>

        <!--seccion de datos de contacto  -->
        <div class="container-contact">
            <p class="text-contact">
                Ingrese al sistema y suba sus comprobantes de pago.
            </p>

            <div class="container-button-contact">
                <a href="https://servyviajes.engranedigital.com/sign-in" target="_blank" class="button-contact">
                    Ingrese aqui
                </a>
            </div>
            
            <p class="text-contact">
                Una vez validado el pago, le haremos llegar un correo 
                de confirmación con su clave de reservación.
            </p>
            <p class="text-contact">
                Sin más por el momento quedamos a sus órdenes para cualquier duda al respecto.
            </p>
        </div>
    </div>
</body>
</html>