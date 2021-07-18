<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Stock Alat</title>
            <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">
            <link href="css/sb-admin-2.css" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <h1><span class="badge badge-secondary">Laboratorium Informatika</span></h1>
            <a class="navbar-brand" href="index.php"><br><br></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Stock Alat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="masuk.php">Alat Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="keluar.php">Alat Keluar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Alat Keluar</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Alat
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Alat</th>
                                                <th>Jumlah</th>
                                                <th>Penerima</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            $ambilsemuadatastock = mysqli_query($conn,"select * from keluar k, stock s where s.idbarang = k.idbarang");
                                            while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                $idb = $data['idbarang'];
                                                $idk = $data['idkeluar'];
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $penerima = $data['penerima'];
                                            ?>

                                            <tr>
                                            <td><?=
                                                $tanggal=date('j F Y');
                                                $tz = 'Asia/Jakarta';
                                                $dt = new DateTime("now", new DateTimeZone($tz));
                                                $timestamp = $dt->format('G:i');
                                                echo " pukul $timestamp WIB\n";?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$penerima;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idk;?>">
                                                        Edit
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idk;?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idk;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                            
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Alat</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="penerima" value="<?=$penerima;?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="idk" value="<?=$idk;?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
                                                            </div>
                                                        </form>
                                                
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete<?=$idk;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                            
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Alat?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus <?=$namabarang;?>?
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="kty" value="<?=$qty;?>">
                                                                <input type="hidden" name="idk" value="<?=$idk;?>">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
                                                            </div>
                                                        </form>
                                                
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            };
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Vintya Dewi Anjani | 2000018209</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Alat Keluar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        <select name="barangnya" class="form-control">
                            <?php
                                $ambilsemuadatanya = mysqli_query($conn,"select * from stock");
                                while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                    $namabarangnya = $fetcharray['namabarang'];
                                    $idbarangnya = $fetcharray['idbarang'];
                                
                            ?>

                            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

                            <?php
                                }
                            ?>
                        </select>
                        <br>
                        <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
                        <br>
                        <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="addbarangkeluar">Submit</button>
                    </div>
                </form>
        
            </div>
        </div>
    </div>
</html>
