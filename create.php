<?php
require_once "config.php";

$nama_depan = $nama_belakang = $email = $nomor_telepon = $alamat = "";
$nama_depan_error = $nama_belakang_error = $email_error = $nomor_telepon_error = $alamat_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_depan = trim($_POST["nama_depan"]);
    if (empty($nama_depan)) {
        $nama_depan_error = "Nama depan wajib isi.";
    } elseif (!filter_var($nama_depan, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $nama_depan_error = "Nama belakang tidak bolah kosong.";
    } else {
        $nama_depan = $nama_depan;
    }

    $nama_belakang = trim($_POST["nama_belakang"]);

    if (empty($nama_belakang)) {
        $nama_belakang_error = "Nama Belakang harus di isi.";
    } elseif (!filter_var($nama_depan, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $nama_belakang_error = "Nama Belakang Invalid.";
    } else {
        $nama_belakang = $nama_belakang;
    }

    $email = trim($_POST["email"]);
    if (empty($email)) {
        $email_error = "Email Wajib Di Isi.";
    } elseif (!filter_var($nama_depan, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $email_error = "Alamat email tidak valid.";
    } else {
        $email = $email;
    }

    $nomor_telepon = trim($_POST["nomor_telepon"]);
    if(empty($nomor_telepon)) {
        $nomor_telepon_error = "Nomor Telp wajid di isi.";
    } else {
        $nomor_telepon = $nomor_telepon;
    }

    $alamat = trim($_POST["alamat"]);
    if(empty($alamat)) {
        $alamat_error = "Alamat wajib isi.";
    } else {
        $alamat = $alamat;
    }

    
    if (empty($nama_depan_error) && empty($nama_belakang_error) && empty($email_error) && empty($nomor_telepon_error) && empty($address_error) ) {
          $sql = "INSERT INTO `anggota` (`nama_depan`, `nama_belakang`, `email`, `telp`, `alamat`) VALUES ('$nama_depan', '$nama_belakang', '$email', '$nomor_telepon', '$alamat')";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
               echo "Something went wrong. Please try again later.";
          }
      }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota</title>
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
                        <h2>Tambah Anggota</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_depan_error)) ? 'has-error' : ''; ?>">
                            <label>Nama Depan</label>
                            <input type="text" name="nama_depan" class="form-control" value="">
                            <span class="help-block"><?php echo $nama_depan_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nama_belakang_error)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>
                            <input type="text" name="nama_belakang" class="form-control" value="">
                            <span class="help-block"><?php echo $nama_belakang_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_error)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="">
                            <span class="help-block"><?php echo $email_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nomor_telepon_error)) ? 'has-error' : ''; ?>">
                            <label>Nomor Telepon</label>
                            <input type="number" name="nomor_telepon" class="form-control" value="">
                            <span class="help-block"><?php echo $nomor_telepon_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($alamat_error)) ? 'has-error' : ''; ?>">
                            <label>alamat</label>
                            <textarea name="alamat" class="form-control"></textarea>
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