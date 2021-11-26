<?php
$title_page = "Edit Data Anggota";
require_once('./includes/header.php'); ?>
<?php require_once('./includes/navbar-top.php'); ?>


<!--Side Nav-->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php
        $curr_page = basename(__FILE__);
        require_once("./includes/sidebar.php") ?>
    </div>

    <?php
    if (isset($_POST['edit'])) {
        $id_agt = $_POST['id_agt'];
        $url = "http://localhost/sisnu-pegandon/backend/anggota-edit.php?id_agt=" . $id_agt;
        header("Location: {$url}");
    }
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                <div class="container-fluid">
                    <div class="page-header-content">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                            <span>Edit Data Anggota</span>
                        </h1>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['id_agt'])) {
                $id_agt = $_GET['id_agt'];
                $sql = "SELECT * FROM anggota WHERE id_agt = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':id' => $id_agt
                ]);
                $anggota = $stmt->fetch(PDO::FETCH_ASSOC);
                $nama_agt = $anggota['nama_agt'];
                $kelamin_agt = $anggota['kelamin_agt'];
                $tmp_lahir = $anggota['tmp_lahir'];
                $tgl_lahir = $anggota['tgl_lahir'];
                $rt = $anggota['rt'];
                $rw = $anggota['rw'];
                $status = $anggota['status'];
                $pekerjaan = $anggota['pekerjaan'];
                $telp = $anggota['telp'];
            }
            ?>
            <?php
            if (isset($_POST['update'])) {
                $nama_agt = trim($_POST['nama_agt']);
                $kelamin_agt = $_POST['kelamin_agt'];
                $tmp_lahir = $_POST['tmp_lahir'];
                $tgl_lahir = $_POST['tgl_lahir'];
                $rt = $_POST['rt'];
                $rw = $_POST['rw'];
                $status = $_POST['status'];
                $pekerjaan = $_POST['pekerjaan'];
                $telp = $_POST['telp'];
                $sqlUpdate = "UPDATE anggota SET nama_agt = :nama, kelamin_agt = :kelamin, tmp_lahir = :tmp, tgl_lahir = :tgl, rt = :rt, rw = :rw, status = :status, pekerjaan = :pekerjaan, telp = :telp WHERE id_agt = :id";
                $stmtUpdate = $pdo->prepare($sqlUpdate);
                $stmtUpdate->execute([
                    ':id' => $_GET['id_agt'],
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
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Edit Data Anggota</div>
                    <div class="card-body">
                        <form action="anggota-edit.php?id_agt=<?= $_GET['id_agt'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_agt">Nama :</label>
                                <input name="nama_agt" value="<?= $nama_agt ?>" class="form-control" id="nama_agt" type="text" placeholder="Nama ..." required />
                            </div>
                            <div class="form-group">
                                <label for="kelamin">Jenis Kelamin :</label>
                                <select name="kelamin_agt" class="form-control" id="kelamin">
                                    <option value="Laki-Laki" <?= $kelamin_agt == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?= $kelamin_agt == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tmp_lahir">Tempat Lahir :</label>
                                <input name="tmp_lahir" value="<?= $tmp_lahir ?>" class="form-control" id="tmp_lahir" type="text" placeholder="Tempat Lahir ..." required />
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir :</label>
                                <input name="tgl_lahir" value="<?= $tgl_lahir ?>" class="form-control" id="tgl_lahir" type="date" placeholder="Tanggal Lahir ..." required />
                            </div>
                            <div class="form-group">
                                <label for="rt">RT :</label>
                                <input name="rt" value="<?= $rt ?>" class="form-control" id="rt" type="text" placeholder="RT ..." required />
                            </div>
                            <div class="form-group">
                                <label for="rw">RW :</label>
                                <input name="rw" value="<?= $rw ?>" class="form-control" id="rw" type="text" placeholder="RW ..." required />
                            </div>
                            <div class="form-group">
                                <label for="status">Status :</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="Sudah Menikah" <?= $status == 'Sudah Menikah' ? 'selected' : ''; ?>>Sudah Menikah</option>
                                    <option value="Belum Menikah" <?= $status == 'Belum Menikah' ? 'selected' : ''; ?>>Belum Menikah</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan :</label>
                                <input name="pekerjaan" value="<?= $pekerjaan ?>" class="form-control" id="pekerjaan" type="text" placeholder="Pekerjaan ..." required />
                            </div>
                            <div class="form-group">
                                <label for="telp">Telepon :</label>
                                <input name="telp" value="<?= $telp ?>" class="form-control" id="telp" type="text" placeholder="Telepon ..." required />
                            </div>
                            <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Table-->

        </main>

        <?php require_once('./includes/footer.php'); ?>