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

        $traveller_code = "SELECT Dni_viajero FROM viajero ORDER BY Dni_viajero DESC";
        $t_result = mysqli_query($con, $traveller_code);
        $Dni_viajero = "";

        $Dni_viajero = getCode($Dni_viajero, $t_result);

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
    
                        $cek = mysqli_query($con, "SELECT * FROM viajero WHERE Dni_viajero='$Dni_viajero'");
                        if(mysqli_num_rows($cek) == 0){

                                $insert = mysqli_query($con, "INSERT INTO viajero(Dni_viajero, Nombre, Direccion, Telefono) VALUES ('$Dni_viajero','$Nombre_viajero','$Direccion_viajero','$Telefono_viajero');") or die(mysqli_error($con));

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
                            Error. código exite!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" aria-hidden="true"></button>
                            </div>'; 
                        }
                    }
                ?>

                <form class="form-horizontal" action="" method="POST">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Dni del viajero viajero</label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_viaje" class="form-control" value=" <?php strval($Dni_viajero); echo $Dni_viajero;  ?>" disabled>
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
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-6">
                            <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
                            <a href="travellerTable.php" class="btn btn-sm btn-danger">Cancelar</a>
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