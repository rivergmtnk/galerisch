<?php
include 'koneksi.php';
session_start();

// Periksa apakah parameter ID tersedia dalam URL
if(isset($_GET['id'])) {
    // Ambil ID yang dikirimkan melalui parameter GET
    $id = $_GET['id'];
    
    // Query untuk mengambil data post berdasarkan ID
    $sql = "SELECT * FROM posts WHERE judul = $judul";
    $result = mysqli_query($conn, $sql);
    
    // Periksa apakah data post ditemukan
    if(mysqli_num_rows($result) > 0) {
        // Ambil data post
        $kategori = mysqli_fetch_assoc($result);
    } else {
        echo "Posts tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan";
    exit();
}

// Proses form jika tombol submit ditekan
if(isset($_POST['submit'])) {
    // Ambil nilai judul yang dikirimkan melalui form
    $judul = $_POST['judul'];
    
    // Query untuk melakukan update data post
    $sql_update = "UPDATE posts SET judul='$judul', kategori='$kategori_id', isi='$isi', petugas='$petugas_id' WHERE id=$id";
    
    // Eksekusi query update
    if(mysqli_query($conn, $sql_update)) {
        // Redirect kembali ke halaman post setelah update berhasil
        header("Location: post.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">GALERI SEKOLAH</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>DASHBOARD</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="m_admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>MANAJEMEN ADMIN</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="kategori.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>KATEGORI </span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="post.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>POST</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="galeri.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>GALERI</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                 <!-- Topbar -->
                                <!-- Topbar -->
                                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
            <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
<!-- End of Topbar -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Edit Post</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="judul">Judul Post</label>
                                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul['judul']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori Post</label>
                                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $kategori_id['kategori']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="petugas">Petugas Post</label>
                                            <input type="text" class="form-control" id="petugas" name="petugas" value="<?php echo $petugas_id['petugas']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status Post</label>
                                            <input type="text" class="form-control" id="status" name="status" value="<?php echo $status['status']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="created_at">Di buat pada</label>
                                            <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo $created_at['created_at']; ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                        <a href="post.php" class="btn btn-secondary">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
