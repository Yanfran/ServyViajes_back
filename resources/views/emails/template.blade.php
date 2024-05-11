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
            <img class="img-logo" src="https://bari-mercedesbenz.com.ar/wp-content/uploads/2021/07/400x400.png" alt="">
        </div>

        <!-- seccion detalles usuario--->
        <div class="container-detail-user">
            <h5 class="name-user">Licenciatura Juan Salazar</h5>
            <h5 class="text-evento">Agradecemos su registro a congreso de medicina</h5>
            <p class="text-access-1">Para continuar con su proceso, le hacemos llegar la información necesaria.</p>
            <table class="container-access">
                <tbody>
                    <tr>
                        <td>
                            <p class="text-access">
                                Correo electrónico: <span class="access">juansalazar@gmail.com</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-access">
                                Contraseña: <span class="access">juansalazar@gmail.com</span>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- seccion detalles evento-->
        <div class="container-detail-event">
            <table class="table-event">
                <tbody>
                    <tr>
                        <td>
                            <p class="text-detail-event">Fecha Inicio 12-02-2023</p>
                        </td>
                        <td>        
                            <p class="text-detail-event">Medico</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-detail-event">Fecha Fin 12-09-2023</p>
                        </td>
                        <td>
                            <p class="text-detail-event">Hotel Romance</p>
                        </td>
                    <tr>
                </tbody>
            </table>
        </div>

        <!-- seccion detalles pago-->
        <div class="container-detail-pay">
            <h3 class="title">Datos para pago</h3>
        </div>

        <!--seccion de datos de contacto  -->
        <div class="container-contact">
            <p class="text-contact">
                Ingrese al sistema y suba su comprobante de pago, así como su constancia 
                de situación fiscal actualizada (CSF) en caso solicitar factura.
            </p>

            <div class="container-button-contact">
                <a class="button-contact">Ingrese aqui</a>
            </div>
            
            <p class="text-contact">
                Una vez validado el pago, le haremos llegar su pase de acreditación y 
                la factura correspondiente (si fuera el caso)
            </p>
            <p class="text-contact">
                Para cualquier duda o comentario, con gusto estaremos a sus órdenes 
                por correo electrónico. Correo electrónico de contacto
            </p>
        </div>
    </div>
</body>
</html>