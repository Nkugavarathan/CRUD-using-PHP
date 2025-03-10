<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>LIst of Clients</h2>
        <a href="./crud.php" class=" btn btn-primary" role="button">ADD</a>

        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Define database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db_name = "phpmysql";

                $conneciton = new mysqli($servername, $username, $password, $db_name);

                if ($conneciton) {
                    echo "db connected successfully";
                } else {
                    echo "Error occured : " . $conneciton->connect_error;
                }

                $query = "INSERT INTO clients(name,email,phone,address)
                VALUES ('varathan','kugan@gmail.com','0775019192','no 168yogaputarm')";

                if ($conneciton->query($query) === "TRUE") {
                    echo "Insert successfully";
                } else {
                    echo "Error" . $conneciton->connect_error;
                }
                ?>
                <tr>
                    <td>1</td>
                    <td>kugan</td>
                    <td>kugan@gmail.com</td>
                    <td>099898</td>
                    <td>no 30 gdsfs</td>
                    <td>2025.09.09</td>
                    <td>
                        <a class="btn btn-primary " href="./edit.php">Edit</a>
                        <a class="btn btn-danger" href="./delete.php">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>