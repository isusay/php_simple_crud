<?php
require_once "config.php";


$nama_depan = $nama_depan = $email = $nomor_telepon = $alamat = "";
$nama_depan_error = $nama_belakang_error = $email_error = $nomor_telepon_error = $alamat_error = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

        $nama_depan = trim($_POST["nama_depan"]);
        if (empty($nama_depan)) {
            $nama_depan_error = "First Name is required.";
        } elseif (!filter_var($nama_depan, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $nama_depan_error = "First Name is invalid.";
        } else {
            $nama_depan = $nama_depan;
        }

        $nama_belakang = trim($_POST["nama_belakang"]);

        if (empty($nama_belakang)) {
            $nama_belakang_error = "Last Name is required.";
        } elseif (!filter_var($nama_depan, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $nama_belakang_error = "Last Name is invalid.";
        } else {
            $nama_belakang = $nama_belakang;
        }

        $email = trim($_POST["email"]);
        if (empty($email)) {
            $email_error = "Email is required.";
        } elseif (!filter_var($nama_depan, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $email_error = "Please enter a valid email.";
        } else {
            $email = $email;
        }

        $nomor_telepon = trim($_POST["nomor_telepon"]);
        if (empty($nomor_telepon)){
            $nomor_telepon_error = "Phone Number is required.";
        } else {
            $nomor_telepon = $nomor_telepon;
        }

        $alamat = trim($_POST["alamat"]);
        if (empty($alamat)) {
            $alamat_error = "Address is required.";
        } else {
            $alamat = $alamat;
        }

    if (empty($nama_depan_error_err) && empty($nama_belakang_error) &&
        empty($email_error) && empty($nomor_telepon_error) && empty($alamat_error) ) {

          $sql = "UPDATE `anggota` SET `nama_depan`= '$nama_depan', `nama_belakang`= '$nama_belakang', `email`= '$email', `telp`= '$nomor_telepon', `alamat`= '$alamat' WHERE id='$id'";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
              echo "Something went wrong. Please try again later.";
          }

    }

    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM anggota WHERE ID = '$id'");

        if ($user = mysqli_fetch_assoc($query)) {
            $nama_depan   = $user["nama_depan"];
            $nama_belakang    = $user["nama_belakang"];
            $email       = $user["email"];
            $nomor_telepon = $user["telp"];
            $alamat     = $user["alamat"];
        } else {
            echo "Something went wrong. Please try again later.";
            header("location: edit.php");
            exit();
        }
        mysqli_close($conn);
    }  else {
        echo "Something went wrong. Please try again later.";
        header("location: edit.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update User</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group <?php echo (!empty($nama_depan_error)) ? 'has-error' : ''; ?>">
                            <label>Nama Depan</label>
                            <input type="text" name="nama_depan" class="form-control" value="<?php echo $nama_depan; ?>">
                            <span class="help-block"><?php echo $nama_depan_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nama_belkang_error)) ? 'has-error' : ''; ?>">
                            <label>Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="form-control" value="<?php echo $nama_belakang; ?>">
                            <span class="help-block"><?php echo $nama_belakang_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_error)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nomor_telepon_error)) ? 'has-error' : ''; ?>">
                            <label>Nomor Telepon</label>
                            <input type="number" name="nomor_telepon" class="form-control" value="<?php echo $nomor_telepon; ?>">
                            <span class="help-block"><?php echo $nomor_telepon_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($alamat_error)) ? 'has-error' : ''; ?>">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control"><?php echo $alamat; ?></textarea>
                            <span class="help-block"><?php echo $alamat_error;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>