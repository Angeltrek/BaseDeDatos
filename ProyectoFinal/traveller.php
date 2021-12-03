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
    ?> 

    <div class="container">
        <div class="content">
            <?php 
                $row = mysqli_fetch_array($result);
            ?>
            <h2>Datos del viajero</h2>
            <div class="table-responsive">
            <table class="table table-striped table-condensed">
                <tr>
                    <th>Dni del viajero</th>
                    <td><?php echo $row['Dni_viajero'];?></td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td><?php echo $row['Nombre'];?></td>
                </tr>
                <tr>
                    <th>Direccion</th>
                    <td><?php echo $row['Direccion'];?></td>
                </tr>
                <tr>
                    <th>Telefono</th>
                    <td><?php echo $row['Telefono'];?></td>
                </tr>
            </table>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>