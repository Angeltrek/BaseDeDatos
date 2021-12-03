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
        $nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
        $query = "SELECT * FROM viaje WHERE Codigo_viaje = '$nik'";
        $result = mysqli_query($con, $query);

        $Codigo_viaje = $nik;

        $Co = "SELECT Codigo_origen FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"; 
        $Codigo_origen = mysqli_fetch_array(mysqli_query($con, $Co))[0];

        $Cd = "SELECT Codigo_destino FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"; 
        $Codigo_destino = mysqli_fetch_array(mysqli_query($con, $Cd))[0];

        $Dni = "SELECT Dni_viajero FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"; 
        $Dni_viajero = mysqli_fetch_array(mysqli_query($con, $Dni))[0];

        $Num_plazas = mysqli_fetch_array(mysqli_query($con, "SELECT Num_plazas FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"))[0];
        $Fecha = mysqli_fetch_array(mysqli_query($con, "SELECT Fecha FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"))[0];
        $Otros_datos = mysqli_fetch_array(mysqli_query($con, "SELECT Otros_datos FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"))[0];

        $Nomv = "SELECT Nombre FROM viajero WHERE Dni_viajero = '$Dni_viajero'";
        $Nombre_viajero = mysqli_fetch_array(mysqli_query($con, $Nomv))[0];
        $Dir = "SELECT Direccion FROM viajero WHERE Dni_viajero = '$Dni_viajero'";
        $Direccion_viajero = mysqli_fetch_array(mysqli_query($con, $Dir))[0];
        $Tel = "SELECT Telefono FROM viajero WHERE Dni_viajero = '$Dni_viajero'";
        $Telefono_viajero = mysqli_fetch_array(mysqli_query($con, $Tel))[0];

        $Nomo = "SELECT Nombre FROM origen WHERE Codigo_origen = '$Codigo_origen'";
        $Nombre_origen = mysqli_fetch_array(mysqli_query($con, $Nomo))[0];
        $DatoO = "SELECT Otros_datos FROM origen WHERE Codigo_origen = '$Codigo_origen'";
        $Otros_datos_Origen = mysqli_fetch_array(mysqli_query($con, $DatoO))[0];

        $Nomd = "SELECT Nombre FROM destino WHERE Codigo_destino = '$Codigo_destino'";
        $Nombre_destino = mysqli_fetch_array(mysqli_query($con, $Nomd))[0];
        $DatoD = "SELECT Otros_datos FROM destino WHERE Codigo_destino = '$Codigo_destino'";
        $Otros_datos_Destino = mysqli_fetch_array(mysqli_query($con, $DatoD))[0];

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

                            $update = mysqli_query($con, "UPDATE viajero SET Nombre='$Nombre_viajero', Direccion='$Direccion_viajero', Telefono='$Telefono_viajero' WHERE Dni_viajero='$Dni_viajero';") or die(mysqli_error($con));
                            $update = mysqli_query($con, "UPDATE origen SET Nombre='$Nombre_origen', Otros_datos='$Otros_datos_Origen' WHERE Codigo_origen='$Codigo_origen';") or die(mysqli_error($con));
                            $update = mysqli_query($con, "UPDATE destino SET Nombre='$Nombre_destino', Otros_datos='$Otros_datos_Destino' WHERE Codigo_destino='$Codigo_destino';") or die(mysqli_error($con));
                            $update = mysqli_query($con, "UPDATE viaje SET Num_plazas='$Num_plazas', Fecha='$Fecha', Otros_datos='$Otros_datos', Dni_viajero='$Dni_viajero' WHERE Codigo_viaje='$Codigo_viaje';") or die(mysqli_error($con));

                            if($update)
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
                ?>

                <form class="form-horizontal" action="" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código del viaje</label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_viaje" class="form-control" value=" <?php echo $Codigo_viaje;  ?>" disabled>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código origen</label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_origen" class="form-control" value=" <?php echo $Codigo_origen;  ?>" disabled>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código destino</label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_destino" class="form-control" value=" <?php echo $Codigo_destino;  ?>" disabled>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Dni del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Dni_viajero" class="form-control" value=" <?php echo $Dni_viajero;  ?>" disabled>
                        </div>      
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">Numero de plazas</label>
                        <div class="col-sm-2">
                            <input type="text" name="Num_plazas" class="form-control" placeholder="Numero de plazas" value="<?php echo $Num_plazas?>" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha</label>
                        <div class="col-sm-2">
                            <input type="text" name="Fecha" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" value="<?php echo $Fecha?>"  required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Otros datos</label>
                        <div class="col-sm-2">
                            <input type="text" name="Otros_datos" class="form-control" placeholder="Otros datos" value="<?php echo $Otros_datos?>" required>
                        </div>      
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Nombre_viajero" class="form-control" placeholder="Nombre del viajero" value="<?php echo $Nombre_viajero?>" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Direccion del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Direccion_viajero" class="form-control" placeholder="Direccion del viajero" value="<?php echo $Direccion_viajero?>" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telefono del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Telefono_viajero" class="form-control" placeholder="Telefono del viajero" value="<?php echo $Telefono_viajero?>" required>
                        </div>      
                    </div>



                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre del Origen</label>
                        <div class="col-sm-2">
                            <input type="text" name="Nombre_origen" class="form-control" placeholder="Nombre del origen" value="<?php echo $Nombre_origen?>" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Otros datos del origen</label>
                        <div class="col-sm-3">
                            <select name="Otros_datos_Origen" class="form-control">
                                <option value="Sin datos"> ----- </option>
                                <option value="Primera clase" <?php if($Otros_datos_Origen=="Primera clase") echo 'selected';?> >Primera clase</option>
                                <option value="Segunda clase" <?php if($Otros_datos_Origen=="Segunda clase") echo 'selected';?>>Segunda clase</option>
                                <option value="Tercera clase" <?php if($Otros_datos_Origen=="Tercera clase") echo 'selected';?>>Tercera clase</option>
                            </select>
                        </div>     
                    </div>


                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre de destino</label>
                        <div class="col-sm-2">
                            <input type="text" name="Nombre_destino" class="form-control" placeholder="Nombre de destino" value="<?php echo $Nombre_destino?>" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Otros datos del destino</label>
                        <div class="col-sm-3">
                            <select name="Otros_datos_Destino" class="form-control">
                                <option value="Sin datos"> ----- </option>
                                <option value="Primera clase" <?php if($Otros_datos_Destino=="Primera clase") echo 'selected';?>>Primera clase</option>
                                <option value="Segunda clase" <?php if($Otros_datos_Destino=="Segunda clase") echo 'selected';?>>Segunda clase</option>
                                <option value="Tercera clase" <?php if($Otros_datos_Destino=="Tercera clase") echo 'selected';?>>Tercera clase</option>
                            </select>
                        </div>     
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-6">
                            <input type="submit" name="add" class="btn btn-sm btn-success" value="Actualizar datos">
                            <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>