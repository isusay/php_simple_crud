<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Aggota</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
  <?php
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        require_once "config.php";

        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM anggota WHERE ID = '$id'");

        if ($user = mysqli_fetch_assoc($query)) {
            $nama_depan   = $user["nama_depan"];
            $nama_belakang    = $user["nama_belakang"];
            $email       = $user["email"];
            $nomor_telepon = $user["telp"];
            $alamat     = $user["alamat"];
        } else {
            header("location: read.php");
            exit();
        }

        mysqli_close($conn);
    } else {
        header("location: read.php");
        exit();
    }
  ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1> View Anggota</h1>
                    </div>
                    <div class="form-group">
                        <label>Nama Depan</label>
                        <p class="form-control-static"><?php echo $nama_belakang ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nama Belakang</label>
                        <p class="form-control-static"><?php echo $nama_belakang ?></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control-static"><?php echo $email ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <p class="form-control-static"><?php echo $nomor_telepon ?></p>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <p class="form-control-static"><?php echo $alamat ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>