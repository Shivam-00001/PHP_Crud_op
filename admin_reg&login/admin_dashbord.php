<?php
include_once ("../include/config.php");
$sql_query = "SELECT * FROM `crud_table` WHERE 1";
$result = mysqli_query($connection, $sql_query);
$sno = 1;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="text-center mb-3">
            <h2 class="border-bottom text-primary">PHP CRUD</h2>
        </div>
        <div class="row">
            <div class="col-9"> </div>
            <div class="col-3 mb-3"> 
            <a class="btn btn-success" href="../create.php">Add New </a>
            </div>
        </div>
        <table class="table table-hover table-border">
            <thead class="table-dark">
                <tr>
                    <th scope="col">SN.</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">LastName</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th colspan="2" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)){?>
                <tr>
                    <th scope="row"> <?= $sno ?> </th>
                    <td><?= $row['name']?></td>
                    <td><?= $row['lname']?></td>
                    <td><?= $row['email']?></td>
                    <td><?= $row['phone']?></td>
                    <td><?= $row['gender']?></td>
                    <td><?= $row['address']?></td>
                    <td><a class="btn btn-sn btn-danger" href="../delete.php?id=<?=$row['id'] ?>">Delete</a></td>
                    <td><a class="btn btn-success" href="../update.php?id=<?=$row['id'] ?>">Edit</a></td>

                </tr>
                <?php $sno++; } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>