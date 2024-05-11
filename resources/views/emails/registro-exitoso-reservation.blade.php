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
            padding-top: 20px;
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
        }
    </style>
</head>
<body class="container-body">
    <div class="container-email">

        <div class="container-logo">
            @if($logoEvento)
                <img class="img-logo" src="https://servyviajes-dev.engranedigital.com/assets/images/{{ $logoEvento }}" alt="">
            @endIf
        </div>

        <!-- seccion detalles usuario--->
        <div class="container-detail-user">
            {{-- @if($gradoAcademicoAsistente && $userName)
                <h5 class="name-user">{{ $gradoAcademicoAsistente }} {{ $userName }}</h5>
            @endIf --}}
            @if($nombreEvento)
                <h5 class="text-evento">Agradecemos su registro a {{ $nombreEvento }}</h5>
            @endIf
            <p class="text-access-1">Para continuar con su proceso, le hacemos llegar la información necesaria.</p>
            @if($isNewUser)
                <table class="container-access">
                    <tbody>
                        <tr>
                            <td>
                                <p class="text-access">
                                    Correo electrónico: <span class="access">{{ $userEmail ?? 'no disponible' }}</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="text-access">
                                    Contraseña: <span class="access">{{ $userPassword ?? 'no disponible'}}</span>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p class="access">parece que ya tienes una cuenta vinculada 
                    con el correo electrónico que proporcionaste.
                </p>
                <p class="access">Este correo electrónico se envía para confirmar 
                    que hemos registrado tu participación en nuestro sistema
                </p>
            @endIf
        </div>
        
        <!-- seccion detalles evento-->
        <div class="container-detail-event">
            <table class="table-event">
                <tbody>
                    <tr>
                        <td>
                            <p class="text-detail-event">
                                Fecha Inicio {{ $fechaInicioEvento ? date('d-m-Y', strtotime($fechaInicioEvento)) : 'no disponible'}}
                            </p>
                        </td>
                        <td>        
                            <p class="text-detail-event">no disponible</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-detail-event">
                                Fecha Fin {{ $fechaTerminoEvento ? date('d-m-Y', strtotime($fechaTerminoEvento)) : 'no disponible' }}
                            </p>
                        </td>
                        <td>
                            <p class="text-detail-event">{{ $sedeEvento ?? 'no disponible' }}</p>
                        </td>
                    <tr>
                </tbody>
            </table>
        </div>

        <!-- seccion detalles pago-->
        <div class="container-detail-pay">
            <h3 class="title">Datos para pago</h3>
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
                    <tr>
                        <td>
                            <p class="columns">Clave reservación: </p>
                        </td>
                        <td>
                            <p class="values">{{ $clave_reservacion ?? 'No disponible'}}</p>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <p class="columns">Total a pagar: </p>
                        </td>
                        <td>
                            <p class="values">${{ $monto_total ?? 'No disponible'}}</p>
                        </td>
                    </tr>             
                </tbody>
            </table>
        </div>

        <!--seccion de datos de contacto  -->
        <div class="container-contact">
            <p class="text-contact">
                Ingrese al sistema y suba su comprobante de pago, así como su constancia 
                de situación fiscal actualizada (CSF) en caso solicitar factura.
            </p>

            <div class="container-button-contact">
                <a href="https://servyviajes.engranedigital.com/sign-in" target="_blank" class="button-contact">
                    Ingrese aqui
                </a>
            </div>
            
            <p class="text-contact">
                Una vez validado el pago, le haremos llegar su pase de acreditación y 
                la factura correspondiente (si fuera el caso)
            </p>
            <p class="text-contact">
                Para cualquier duda o comentario, con gusto estaremos a sus órdenes 
                por correo electrónico. {{ $correoContacto ?? 'no disponible' }}
            </p>
        </div>
    </div>
</body>
</html>

<!-- correo anterior --->

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro exitoso</title>
</head>
<body>
    <h3>Registro exitoso</h3>

    <p>!Hola {{ $userName }} !</p>

    @if($isNewUser)

        <p>Correo electronico: <strong>{{ $userEmail }}</strong></p>
        <p>Contraseña: <strong>{{ $userPassword }}</strong></p>

    @else

        <p>parece que ya tienes una cuenta vinculada 
            con el correo electrónico que proporcionaste.
        </p>
        <p>Este correo electrónico se envía para confirmar 
            que hemos registrado tu participación en nuestro sistema
        </p>

    @endif

    <p>
        Inicia sesión aquí: 
        <a href="https://servyviajes.engranedigital.com/sign-in" target="_blank">
            Iniciar sesion
        </a>
    </p>

    <p>¡Gracias por unirte a nosotros!</p>

    <p>Saludos cordiales</p>
</body>
</html> --}}