<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <title>Macetas Nodo - Incadi</title>
</head>
<body>
    <?php

    $nodo = $_POST["nodo"];
    $var = $_POST["variable"];
    ?>

    <h1>Proyecto IoT</h1>
    <h2>Datos del nodo: <?php echo $nodo; ?> y la variable: <?php echo $var; ?> </h2>

    <table border="2px">
        <tr> <th>Valor</th> <th>Fecha </th></tr>
        <?php 
            
            $url_rest = "http://industrial.api.ubidots.com/api/v1.6/devices/nodo1/values?token=BBFF-DzS0U1YMX94QwFfzOTIP36bPsPUpIG";
            date_default_timezone_set('America/Bogota');
            $curl = curl_init($url_rest);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);

            if($respuesta === false){
                curl_close($curl);
                die ("Error en la conexión");
            }
            curl_close($curl);

            $res = json_decode($respuesta);
            $resul = $res -> results;

            $tam = count($resul);

            for( $i = 0; $i < $tam; $i++){
                $j = $resul[$i];
                $valor = $j -> value;
                $time = $j -> timestamp;

                $fecha = date("F j, Y, g:i a", $time/1000);
                echo "<tr><td>$valor</td><td>$fecha</td></tr>";
            }
        ?>
        <a href="index.html"> VOLVER</a>
    </table>
</body>
</html>