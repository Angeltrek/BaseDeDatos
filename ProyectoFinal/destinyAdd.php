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

        $destiny_code = "SELECT Codigo_destino FROM destino ORDER BY Codigo_destino DESC";
        $t_result = mysqli_query($con, $destiny_code);
        $Codigo_destino = "";

        $Codigo_destino = getCode($Codigo_destino, $t_result);

    ?> 

    <div class="container">
        <div class="content">
            <h2>Agregar datos</h2>

                <?php
                    if(isset($_POST['add']))
                    {
                        $Nombre_destino = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre_destino"],ENT_QUOTES)));
                        $Otros_datos_Destino = mysqli_real_escape_string($con,(strip_tags($_POST["Otros_datos_Destino"],ENT_QUOTES)));
    
                        $cek = mysqli_query($con, "SELECT * FROM destino WHERE Codigo_destino='$Codigo_destino'");
                        if(mysqli_num_rows($cek) == 0){

                            $insert = mysqli_query($con, "INSERT INTO destino(Codigo_destino, Nombre, Otros_datos) VALUES ('$Codigo_destino','$Nombre_destino','$Otros_datos_Destino');") or die(mysqli_error($con));

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
                        <label class="col-sm-3 control-label">Código Destino </label>
                        <div class="col-sm-2">
                            <input type="text" name="Codigo_destino" class="form-control" value=" <?php strval($Codigo_destino); echo $Codigo_destino;  ?>">
                        </div>      
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre del Destino</label>
                        <div class="col-sm-2">
                            <input type="text" name="Nombre_destino" class="form-control" placeholder="Nombre del destino" required>
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
                            <a href="originTable.php" class="btn btn-sm btn-danger">Cancelar</a>
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