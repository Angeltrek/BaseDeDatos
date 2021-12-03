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
        $query = "SELECT * FROM destino";
        $result = mysqli_query($con, $query);
    ?> 

    <?php 

        if(isset($_GET['aksi']) == 'delete'){
                $nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
                $Codigo_destino = $nik;
                $cek = mysqli_query($con, "SELECT * FROM destino WHERE Codigo_destino='$Codigo_destino'");
                
            if(mysqli_num_rows($cek) == 0){

                echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> No se encontraron datos.</div>";

            }
            else{

                $delete = mysqli_query($con, "DELETE FROM destino WHERE Codigo_destino='$Codigo_destino';");

                if($delete){
                    header("Location: destinyTable.php");die();
                }
                else{
                    echo "<div class='alert alert-warning alert-dismissible' role='alert' >Error. No se eliminaron los datos!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' aria-hidden='true'></button></div>";
                }
            }
        }
    ?>

    <div class="container">
        <div class="content">
            <h2>Lista de destino</h2>
            <div class="table-responsive">
            <table class="table table-striped table-hover">
            <tr>
                <th>Codigo de destino</th>
                <th>Pais</th>
                <th>Otros datos</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>

            <?php 
                while($row = mysqli_fetch_array($result)){
                    echo" 
                    <tr> 
                        <td>".$row['Codigo_destino']."</td> 
                        <td>".$row['Nombre']."</td> 
                        <td>".$row['Otros_datos']."</td> 
                        <td> <a class='btn btn-sm btn-primary' href='destinyEdit.php?nik=".$row['Codigo_destino']."'>Editar datos</a></td>
                        <td> <a class='btn btn-sm btn-danger' href='destinyTable.php?aksi=delete&nik=".$row['Codigo_destino']."' title='Eliminar' onclick='return confirm(\"Estas seguro de borrar los datos de ".$row['Nombre']."?\")'>Eliminar</a></td>
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