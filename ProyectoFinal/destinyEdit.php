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
        $query = "SELECT * FROM destino WHERE Codigo_destino = '$nik'";
        $result = mysqli_query($con, $query);

        $Codigo_destino = $nik;

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

                        $Nombre_destino = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre_destino"],ENT_QUOTES)));
                        $Otros_datos_Destino = mysqli_real_escape_string($con,(strip_tags($_POST["Otros_datos_Destino"],ENT_QUOTES)));

                            $update = mysqli_query($con, "UPDATE destino SET Nombre='$Nombre_destino', Otros_datos='$Otros_datos_Destino' WHERE Codigo_destino='$Codigo_destino';") or die(mysqli_error($con));

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
                        <label class="col-sm-3 control-label">Código destino</label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_destino" class="form-control" value=" <?php echo $Codigo_destino;  ?>" disabled>
                        </div>      
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre del destino</label>
                        <div class="col-sm-2">
                            <input type="text" name="Nombre_destino" class="form-control" placeholder="Nombre del destino" value="<?php echo $Nombre_destino?>" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Otros datos del destino</label>
                        <div class="col-sm-3">
                            <select name="Otros_datos_Origen" class="form-control">
                                <option value="Sin datos"> ----- </option>
                                <option value="Primera clase" <?php if($Otros_datos_Destino=="Primera clase") echo 'selected';?> >Primera clase</option>
                                <option value="Segunda clase" <?php if($Otros_datos_Destino=="Segunda clase") echo 'selected';?>>Segunda clase</option>
                                <option value="Tercera clase" <?php if($Otros_datos_Destino=="Tercera clase") echo 'selected';?>>Tercera clase</option>
                            </select>
                        </div>     
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-6">
                            <input type="submit" name="add" class="btn btn-sm btn-success" value="Actualizar datos">
                            <a href="destinyTable.php" class="btn btn-sm btn-danger">Cancelar</a>
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