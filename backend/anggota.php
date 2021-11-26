<?php
$title_page = "Anggota";
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
                    <div class="page-header-content d-flex align-items-center justify-content-between text-white">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="users"></i></div>
                            <span>Anggota</span>
                        </h1>
                        <a href="anggota-new.php" title="Tambah Data Anggota" class="btn btn-white">
                            <div class="page-header-icon"><i data-feather="plus"></i></div>
                        </a>
                    </div>
                </div>
            </div>

            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Anggota</div>
                    <div class="card-body">
                        <div class="datatable table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Kelamin</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>RT</th>
                                        <th>RW</th>
                                        <th>Status</th>
                                        <th>Pekerjaan</th>
                                        <th>Telepon</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Image</th>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM anggota";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while ($anggota = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $id_agt = $anggota['id_agt'];
                                        $nama_agt = $anggota['nama_agt'];
                                        $kelamin_agt = $anggota['kelamin_agt'];
                                        $tmp_lahir = $anggota['tmp_lahir'];
                                        $tgl_lahir = $anggota['tgl_lahir'];
                                        $rt = $anggota['rt'];
                                        $rw = $anggota['rw'];
                                        $status = $anggota['status'];
                                        $pekerjaan = $anggota['pekerjaan'];
                                        $telp = $anggota['telp']; ?>
                                        <tr>
                                            <td><?= $id_agt ?></td>
                                            <td><?= $nama_agt ?></td>
                                            <td><?= $kelamin_agt ?></td>
                                            <td><?= $tmp_lahir ?></td>
                                            <td><?= $tgl_lahir ?></td>
                                            <td><?= $rt ?></td>
                                            <td><?= $rw ?></td>
                                            <td><?= $status ?></td>
                                            <td><?= $pekerjaan ?></td>
                                            <td><?= $telp ?></td>
                                            <td>
                                                <form action="anggota-edit.php" method="POST">
                                                    <input type="hidden" name="id_agt" value="<?= $id_agt ?>">
                                                    <button name="edit" type="submit" class="btn btn-blue btn-icon"><i data-feather="edit"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($_POST['delete-agt'])) {
                                                    $id_agt = $_POST['id_agt'];
                                                    $sql = "DELETE FROM anggota WHERE id_agt = :id";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([
                                                        ':id' => $id_agt
                                                    ]);
                                                    header("Location: anggota.php");
                                                }
                                                ?>
                                                <form action="anggota.php" method="POST">
                                                    <input type="hidden" name="id_agt" value="<?= $id_agt ?>">
                                                    <button name="delete-agt" type="submit" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Table-->

        </main>

        <?php require_once('./includes/footer.php'); ?>