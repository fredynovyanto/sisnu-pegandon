<?php
$title_page = "Tambah Data Anggota";
require_once('./includes/header.php'); ?>
<?php require_once('./includes/navbar-top.php'); ?>


<!--Side Nav-->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php
        $curr_page = basename(__FILE__);
        require_once("./includes/sidebar.php") ?>
    </div>


    <div id="layoutSidenav_content">
        <main>
            <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                <div class="container-fluid">
                    <div class="page-header-content">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                            <span>Tambah Data Anggota</span>
                        </h1>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['create'])) {
                $nama_agt = trim($_POST['nama_agt']);
                $kelamin_agt = $_POST['kelamin_agt'];
                $tmp_lahir = $_POST['tmp_lahir'];
                $tgl_lahir = $_POST['tgl_lahir'];
                $rt = $_POST['rt'];
                $rw = $_POST['rw'];
                $status = $_POST['status'];
                $pekerjaan = $_POST['pekerjaan'];
                $telp = $_POST['telp'];
                $sql = "INSERT INTO anggota (nama_agt, kelamin_agt, tmp_lahir, tgl_lahir, rt, rw, status, pekerjaan, telp)
                            VALUES (:nama, :kelamin, :tmp, :tgl, :rt, :rw, :status, :pekerjaan, :telp)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':nama' => $nama_agt,
                    ':kelamin' => $kelamin_agt,
                    ':tmp' => $tmp_lahir,
                    ':tgl' => $tgl_lahir,
                    ':rt' => $rt,
                    ':rw' => $rw,
                    ':status' => $status,
                    ':pekerjaan' => $pekerjaan,
                    ':telp' => $telp
                ]);
                header("Location: anggota.php");
            }
            ?>
            <!--Start Form-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Tambah Data Anggota</div>
                    <div class="card-body">
                        <form action="anggota-new.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_agt">Nama :</label>
                                <input name="nama_agt" class="form-control" id="nama_agt" type="text" placeholder="Nama ..." required />
                            </div>
                            <div class="form-group">
                                <label for="kelamin">Jenis Kelamin :</label>
                                <select name="kelamin_agt" class="form-control" id="kelamin">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tmp_lahir">Tempat Lahir :</label>
                                <input name="tmp_lahir" class="form-control" id="tmp_lahir" type="text" placeholder="Tempat Lahir ..." required />
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir :</label>
                                <input name="tgl_lahir" class="form-control" id="tgl_lahir" type="date" placeholder="Tanggal Lahir ..." required />
                            </div>
                            <div class="form-group">
                                <label for="rt">RT :</label>
                                <input name="rt" class="form-control" id="rt" type="text" placeholder="RT ..." required />
                            </div>
                            <div class="form-group">
                                <label for="rw">RW :</label>
                                <input name="rw" class="form-control" id="rw" type="text" placeholder="RW ..." required />
                            </div>
                            <div class="form-group">
                                <label for="status">Status :</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="Sudah Menikah">Sudah Menikah</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan :</label>
                                <input name="pekerjaan" class="form-control" id="pekerjaan" type="text" placeholder="Pekerjaan ..." required />
                            </div>
                            <div class="form-group">
                                <label for="telp">Telepon :</label>
                                <input name="telp" class="form-control" id="telp" type="text" placeholder="Telepon ..." required />
                            </div>
                            <button name="create" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Form-->

        </main>

        <?php require_once('./includes/footer.php'); ?>