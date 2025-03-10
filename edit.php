<?php
$name = "";
$email = "";
$phonenumber = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $phonenumber = $_POST['phonenumber'];
    // $address = $_POST['address'];
    if (!isset($_GET['id'])) {
        header("Location:index.php");
        exit;
    }

    include("database.php");

    $id = $_GET['id'];

    $query = "SELECT * FROM clients WHERE ID=$id";
    $result = $connection->query($query);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location:index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phonenumber = $row["phone"];
    $address = $row["address"];
} else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];

    do {
        if (empty($name) || empty($email) || empty($phonenumber) || empty($address)) {
            $errorMessage = "All th fields are required";
            break;
        }

        $query = "UPDATE clients" .
            "SET name='$name' email='$email' phone='$phonenumber' address='$address'. 
            WHERE id=$id";

        $result = $connection->query($query);

        if
    } while (false);
}
?>
<html>

<body>
    <div class="container p-3 my-5 ">
        <h2>New Client</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form action="insert.php" method="get" id="clientForm">
            <input type="hidden" value="<?php echo $id ?>">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Phone number</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="phonenumber" value="<?php echo $phonenumber ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-8">
                    <input class="form-control" name="address" value="<?php echo $address ?>"> </input>
                </div>
            </div>

            <!-- success message -->

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>

            <div class=" row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <button type="button" class="btn btn-warning" onclick="resetForm()">Reset</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a type="submit" class="btn btn-danger" href="./index.php">Cancel</a>
                </div>

            </div>
        </form>
    </div>

</body>

</html>