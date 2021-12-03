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
        $query = "SELECT * FROM viajero WHERE Dni_viajero = '$nik'";
        $result = mysqli_query($con, $query);

        $Dni_viajero = $nik;

        $Nomv = "SELECT Nombre FROM viajero WHERE Dni_viajero = '$Dni_viajero'";
        $Nombre_viajero = mysqli_fetch_array(mysqli_query($con, $Nomv))[0];
        $Dir = "SELECT Direccion FROM viajero WHERE Dni_viajero = '$Dni_viajero'";
        $Direccion_viajero = mysqli_fetch_array(mysqli_query($con, $Dir))[0];
        $Tel = "SELECT Telefono FROM viajero WHERE Dni_viajero = '$Dni_viajero'";
        $Telefono_viajero = mysqli_fetch_array(mysqli_query($con, $Tel))[0];

    ?> 

    <div class="container">
        <div class="content">
            <h2>Agregar datos</h2>

                <?php
                    if(isset($_POST['add']))
                    {

                        $Nombre_viajero = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre_viajero"],ENT_QUOTES)));
                        $Direccion_viajero = mysqli_real_escape_string($con,(strip_tags($_POST["Direccion_viajero"],ENT_QUOTES)));
                        $Telefono_viajero = mysqli_real_escape_string($con,(strip_tags($_POST["Telefono_viajero"],ENT_QUOTES)));

                            $update = mysqli_query($con, "UPDATE viajero SET Nombre='$Nombre_viajero', Direccion='$Direccion_viajero', Telefono='$Telefono_viajero' WHERE Dni_viajero='$Dni_viajero';") or die(mysqli_error($con));

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
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Dni del viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Dni_viajero" class="form-control" value=" <?php echo $Dni_viajero;  ?>" disabled>
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
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-6">
                            <input type="submit" name="add" class="btn btn-sm btn-success" value="Actualizar datos">
                            <a href="TravellerTable.php" class="btn btn-sm btn-danger">Cancelar</a>
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