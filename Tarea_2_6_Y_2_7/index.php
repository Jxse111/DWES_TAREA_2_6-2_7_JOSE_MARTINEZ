<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro de Usuario</title>
    </head>
    <body>
        <?php
        require_once './funciones_Validacion.php';
        $nombreSinSanear = filter_input(INPUT_GET, "nombre");
        $edadSinSanear = filter_input(INPUT_GET, "edad");
        $emailSinSanear = filter_input(INPUT_GET, "email");
        $urlSinSanear = filter_input(INPUT_GET, "url");

        $CamposCompletos = filter_has_var(INPUT_GET, "nombre") && filter_has_var(INPUT_GET, "edad") &&
                filter_has_var(INPUT_GET, "sexo") && filter_has_var(INPUT_GET, "email") && filter_has_var(INPUT_GET, "aficiones") &&
                filter_has_var(INPUT_GET, "provincias") && filter_has_var(INPUT_GET, "url");

        $camposValidos = false; // Define una variable inicializada

        if ($CamposCompletos) {
            $nombre = validarCadena(filter_input(INPUT_GET, "nombre"));
            $edad = validarEdad(filter_input(INPUT_GET, "edad"));
            $sexo = validarSexo(filter_input(INPUT_GET, "sexo"));
            $email = validarEmail(filter_input(INPUT_GET, "email"));
            $aficiones = validarAficiones($_GET["aficiones"]);
            $provincias = validarProvincias(filter_input(INPUT_GET, "provincias"));
            $url = validarUrl(filter_input(INPUT_GET, "url"));

            $camposValidos = $nombre && $edad && $sexo && $email && $aficiones && $provincias && $url;
        }

        if (!$camposValidos) {
            $mensaje = "ERROR: No puede haber campos vacíos o no completos";
        } else {
            $mensaje = "El usuario $nombre se ha registrado con éxito en la sede de la provincia $provincias";
        }
        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="get">
            <label>Introduce un nombre: <input type="text" name="nombre" value="<?php if (filter_has_var(INPUT_GET, "nombre")) echo $nombreSinSanear ?>"></label><br><br>

            <label>Introduce una edad: <input type="text" name="edad" value="<?php if (filter_has_var(INPUT_GET, "edad")) echo $edadSinSanear ?>"></label><br><br>

            <label>Introduce un sexo:</label><br><br>
            <input type="radio" name="sexo" value="mujer"> Mujer<br><br>
            <input type="radio" name="sexo" value="hombre"> Hombre<br><br>
            <label>Introduce una email: <input type ="text" name="email" value="<?php if (filter_has_var(INPUT_GET, "email")) echo $emailSinSanear ?>"><br><br>
                <label>Introduce tus aficiones:</label><br><br>
                <input type="checkbox" name="aficiones[]" value="deportes"> Deportes
                <input type="checkbox" name="aficiones[]" value="musica"> Música
                <input type="checkbox" name="aficiones[]" value="alimentacion"> Alimentación
                <input type="checkbox" name="aficiones[]" value="moda"> Moda<br><br>

                <label>Selecciona la provincia:</label>
                <select name="provincias"> 
                    <option value="0" selected="selected">Seleccione una opción</option>
                    <option value="Almería">Almería</option>
                    <option value="Granada">Granada</option>
                    <option value="Córdoba">Córdoba</option>
                    <option value="Jaen">Jaén</option>
                    <option value="Sevilla">Sevilla</option>
                    <option value="Huelva">Huelva</option>
                    <option value="Malaga">Málaga</option>
                </select>
                <br><br>
                <label>Introduce la url a tu perfil público: <input type ="text" name="url" value="<?php if (filter_has_var(INPUT_GET, "url")) echo $urlSinSanear ?>"><br><br>
                    <button type="submit" name="enviar">Enviar</button>
                    <br><br>

                    <div>
                        <p><?php if (isset($mensaje)) echo $mensaje ?></p>
                        <p><?php print_r($_GET) ?></p>
                    </div>
                    </form>
                    </body>
                    </html>
