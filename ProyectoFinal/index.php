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
        $query = "SELECT * FROM viaje";
        $result = mysqli_query($con, $query);
    ?> 

    <?php 

        if(isset($_GET['aksi']) == 'delete'){
                $nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
                $Codigo_viaje = $nik;
                $cek = mysqli_query($con, "SELECT * FROM viaje WHERE Codigo_viaje='$Codigo_viaje'");

                $Co = "SELECT Codigo_origen FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"; 
                $Codigo_origen = mysqli_fetch_array(mysqli_query($con, $Co))[0];

                $Cd = "SELECT Codigo_destino FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"; 
                $Codigo_destino = mysqli_fetch_array(mysqli_query($con, $Cd))[0];

                $Dni = "SELECT Dni_viajero FROM viaje WHERE Codigo_viaje = '$Codigo_viaje'"; 
                $Dni_viajero = mysqli_fetch_array(mysqli_query($con, $Dni))[0];
                
            if(mysqli_num_rows($cek) == 0){

                echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> No se encontraron datos.</div>";

            }
            else{

                $delete = mysqli_query($con, "DELETE FROM viajero WHERE Dni_viajero='$Dni_viajero';");
                $delete = mysqli_query($con, "DELETE FROM origen WHERE Codigo_origen='$Codigo_origen';");
                $delete = mysqli_query($con, "DELETE FROM destino WHERE Codigo_destino='$Codigo_destino';");
                $delete = mysqli_query($con, "DELETE FROM viaje WHERE Codigo_viaje='$Codigo_viaje';");

                if($delete){
                    header("Location: index.php");die();
                }
                else{
                    echo "<div class='alert alert-warning alert-dismissible' role='alert' >Error. No se eliminaron los datos!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' aria-hidden='true'></button></div>";
                }
            }
        }
    ?>

    <div class="container">
        <div class="content">
            <h2>Lista de viajes</h2>
            <div class="table-responsive">
            <table class="table table-striped table-hover">
            <tr>
                <th>Código viaje</th>
                <th>Numero de plazas</th>
                <th>Fecha</th>
                <th>Otros datos</th>
                <th>DNI del viajero</th>
                <th>Código de origen</th>
                <th>Código de destino</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>

            <?php 
                while($row = mysqli_fetch_array($result)){
                    echo" 
                    <tr> 
                        <td>".$row['Codigo_viaje']."</td> 
                        <td>".$row['Num_plazas']."</td> 
                        <td>".$row['Fecha']."</td> 
                        <td>".$row['Otros_datos']."</td> 
                        <td> <a href='traveller.php?nik=".$row['Dni_viajero']."'>".$row['Dni_viajero']."</a></td> 
                        <td> <a href='origin.php?nik=".$row['Codigo_origen']."'>".$row['Codigo_origen']."</a></td> 
                        <td> <a href='destiny.php?nik=".$row['Codigo_destino']."'>".$row['Codigo_destino']."</a></td> 
                        <td> <a class='btn btn-sm btn-primary' href='edit.php?nik=".$row['Codigo_viaje']."'>Editar datos</a></td>
                        <td> <a class='btn btn-sm btn-danger' href='index.php?aksi=delete&nik=".$row['Codigo_viaje']."' title='Eliminar' onclick='return confirm(\"Estas seguro de borrar ".$row['Codigo_viaje']."?\")'>Eliminar</a></td>
                    </tr>";
                }
            ?>

            </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>