<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
        include ("templates/components/nav.php");
        include ("server/connectDB.php");

        function getCode ($code, $res){
            while($row = ($res = mysqli_fetch_array($res))){
                $code = (int)$row[0] + 1;
                break;
            }     
            return $code;
        }

        function code($con, $cons){
            return mysqli_query($con, $cons);
        }

        $Codigo_viaje = "";
        $Codigo_viaje = getCode($Codigo_viaje, code($con, "SELECT Codigo_viaje FROM viaje ORDER BY Codigo_viaje DESC"));

        $Dni_viajero = "";
        $Dni_viajero = getCode($Dni_viajero, code($con, "SELECT Dni_viajero FROM viajero ORDER BY Dni_viajero DESC"));

        $O_code = "SELECT Codigo_origen FROM origen ORDER BY Codigo_origen DESC";
        $O_result = mysqli_query($con, $O_code);
        $Codigo_origen = "";

        $Codigo_origen = getCode($Codigo_origen, $O_result);

        $D_code = "SELECT Codigo_destino FROM destino ORDER BY Codigo_destino DESC";
        $D_result = mysqli_query($con, $D_code);
        $Codigo_destino = "";

        $Codigo_destino = getCode($Codigo_destino, $D_result);

    ?> 

    <div class="container">
        <div class="content">
            <h2>Agregar datos</h2>

                <?php
                    if(isset($_POST['add']))
                    {
                        $Num_plazas = mysqli_real_escape_string($con,(strip_tags($_POST["Num_plazas"],ENT_QUOTES)));
                        $Fecha = mysqli_real_escape_string($con,(strip_tags($_POST["Fecha"],ENT_QUOTES)));
                        $Otros_datos = mysqli_real_escape_string($con,(strip_tags($_POST["Otros_datos"],ENT_QUOTES)));

                        $Nombre_viajero = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre_viajero"],ENT_QUOTES)));
                        $Direccion_viajero = mysqli_real_escape_string($con,(strip_tags($_POST["Direccion_viajero"],ENT_QUOTES)));
                        $Telefono_viajero = mysqli_real_escape_string($con,(strip_tags($_POST["Telefono_viajero"],ENT_QUOTES)));

                        $Nombre_origen = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre_origen"],ENT_QUOTES)));
                        $Otros_datos_Origen = mysqli_real_escape_string($con,(strip_tags($_POST["Otros_datos_Origen"],ENT_QUOTES)));

                        $Nombre_destino = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre_destino"],ENT_QUOTES)));
                        $Otros_datos_Destino = mysqli_real_escape_string($con,(strip_tags($_POST["Otros_datos_Destino"],ENT_QUOTES)));
    
                        $cek = mysqli_query($con, "SELECT * FROM viaje WHERE Codigo_viaje='$Codigo_viaje'");

                        if(mysqli_num_rows($cek) == 0){

                                $insert = mysqli_query($con, "INSERT INTO viajero(Dni_viajero, Nombre, Direccion, Telefono) VALUES ('$Dni_viajero','$Nombre_viajero','$Direccion_viajero','$Telefono_viajero');") or die(mysqli_error($con));
                                $insert = mysqli_query($con, "INSERT INTO origen(Codigo_origen, Nombre, Otros_datos) VALUES ('$Codigo_origen','$Nombre_origen','$Otros_datos_Origen');") or die(mysqli_error($con));
                                $insert = mysqli_query($con, "INSERT INTO destino(Codigo_destino, Nombre, Otros_datos) VALUES ('$Codigo_destino','$Nombre_destino','$Otros_datos_Destino');") or die(mysqli_error($con));
                                $insert = mysqli_query($con, "INSERT INTO viaje(Codigo_viaje, Num_plazas, Fecha, Otros_datos, Dni_viajero, Codigo_origen, Codigo_destino) VALUES('$Codigo_viaje','$Num_plazas','$Fecha','$Otros_datos','$Dni_viajero','$Codigo_origen','$Codigo_destino');") or die(mysqli_error($con));

                                if($insert)
                                {
                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" >
                                    Bien hecho! Los datos han sido guardados con éxito.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" aria-hidden="true"></button>
                                    </div>';
                                }
                                else
                                {
                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" >
                                    Error. No se pudo guardar los datos!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" aria-hidden="true"></button>
                                    </div>';
                                }
                        
                        }
                        else
                        {
                            echo '<div class="alert alert-warning alert-dismissible " role="alert" >
                            Error. código existe!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" aria-hidden="true"></button>
                            </div>'; 
                        }
                    }
                ?>

                <form class="form-horizontal" action="" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código del viaje</label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_viaje" class="form-control" value=" <?php strval($Codigo_viaje); echo $Codigo_viaje;  ?>" disabled>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código origen</label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_origen" class="form-control" value=" <?php strval($Codigo_origen); echo $Codigo_origen;  ?>">
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código destino</label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_destino" class="form-control" value=" <?php strval($Codigo_destino); echo $Codigo_destino;  ?>">
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Dni del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Dni_viajero" class="form-control" value=" <?php strval($Dni_viajero); echo $Dni_viajero;  ?>">
                        </div>      
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">Numero de plazas</label>
                        <div class="col-sm-2">
                            <input type="text" name="Num_plazas" class="form-control" placeholder="Numero de plazas" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha</label>
                        <div class="col-sm-2">
                            <input type="date" name="Fecha" class="form-control datepicker" data-date-format="aaaa-mm-dd" min="2020-12-10" max="2022-12-10" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Otros datos</label>
                        <div class="col-sm-2">
                            <input type="text" name="Otros_datos" class="form-control" placeholder="Otros datos" required>
                        </div>      
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Nombre_viajero" class="form-control" placeholder="Nombre del viajero" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Direccion del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Direccion_viajero" class="form-control" placeholder="Direccion del viajero" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telefono del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Telefono_viajero" class="form-control" placeholder="Telefono del viajero" required>
                        </div>      
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre del Origen</label>
                        <div class="col-sm-2">
                            <input type="text" name="Nombre_origen" class="form-control" placeholder="Nombre del origen" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Otros datos del origen</label>
                        <div class="col-sm-3">
                            <select name="Otros_datos_Origen" class="form-control">
                                <option value="Sin datos"> ----- </option>
                                <option value="Primera clase">Primera clase</option>
                                <option value="Segunda clase">Segunda clase</option>
                                <option value="Tercera clase">Tercera clase</option>
                            </select>
                        </div>     
                    </div>


                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre de destino</label>
                        <div class="col-sm-2">
                            <input type="text" name="Nombre_destino" class="form-control" placeholder="Nombre de destino" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Otros datos del destino</label>
                        <div class="col-sm-3">
                            <select name="Otros_datos_Destino" class="form-control">
                                <option value="Sin datos"> ----- </option>
                                <option value="Primera clase">Primera clase</option>
                                <option value="Segunda clase">Segunda clase</option>
                                <option value="Tercera clase">Tercera clase</option>
                            </select>
                        </div>     
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-6">
                            <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
                            <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
                        </div>
                    </div>
            </form>
            <script>        
                    $('.datepicker').datepicker({
                        format: 'aaaa-mm-dd',
                    });   
            </script> 
        </div>
    </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>