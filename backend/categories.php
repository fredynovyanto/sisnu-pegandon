<?php
$title_page = "Kategori";
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
                            <div class="page-header-icon"><i data-feather="chevrons-up"></i></div>
                            <span>Kategori</span>
                        </h1>
                        <a href="new-category.php" title="Add new category" class="btn btn-white">
                            <div class="page-header-icon"><i data-feather="plus"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <!--Table-->
            <div class="container-fluid mt-n10">

                <div class="card mb-4">
                    <div class="card-header">Kategori</div>
                    <div class="card-body">
                        <div class="datatable table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Total Posts</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM categories";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while ($categories = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $category_id = $categories['category_id'];
                                        $category_name = $categories['category_name'];
                                        $sqlpost = "SELECT * FROM posts WHERE post_category_id = :cat_id";
                                        $stmtpost = $pdo->prepare($sqlpost);
                                        $stmtpost->execute([':cat_id' => $category_id
                                        ]);
                                        $countCat = $stmtpost->rowCount();
                                        $sqlUpdate = "UPDATE categories SET category_total_post = :catpost WHERE category_id = :id";
                                        $stmtUpdate = $pdo->prepare($sqlUpdate);
                                        $stmtUpdate->execute([
                                            ':catpost' => $countCat,
                                            ':id' => $category_id
                                        ]);
                                        $category_total_post = $categories['category_total_post'];
                                        $category_status = $categories['category_status'];
                                        $created_by = $categories['created_by']; ?>
                                        <tr>
                                            <td><?= $category_id ?></td>
                                            <td>
                                                <?php
                                                if ($category_total_post == 0) { ?>
                                                    <?= $category_name ?>
                                                <?php   } else { ?>
                                                    <a href="../categories.php?category_id=<?= $category_id ?>&category_name=<?= $category_name ?>" target="_blank">
                                                        <?= $category_name ?>
                                                    </a>
                                                <?php }
                                                ?>

                                            </td>
                                            <td><?= $category_total_post ?></td>
                                            <td><?= $created_by ?></td>
                                            <td>
                                                <?php
                                                if ($category_status == 'Published') { ?>
                                                    <div class="badge badge-success"><?= $category_status ?>
                                                    </div>
                                                <?php   } else { ?>
                                                    <div class="badge badge-warning"><?= $category_status ?>
                                                    </div>
                                                <?php }
                                                ?>

                                            </td>
                                            <td>
                                            <form action="edit-category.php" method="POST">
                                                <input type="hidden" name="edit-id" value="<?= $category_id ?>">
                                                <button name="edit" class="btn btn-blue btn-icon"><i data-feather="edit"></i></button>
                                            </form>
                                                
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($_POST['delete_category'])) {
                                                    $sql = "DELETE FROM categories WHERE category_id = :id";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute([
                                                        ':id' => $_POST['id']
                                                    ]);
                                                    header("Location: categories.php");
                                                }
                                                ?>
                                                <?php
                                                if ($category_total_post == 0) { ?>
                                                    <form action="categories.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $category_id ?>">
                                                        <button name="delete_category" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                    </form>
                                                <?php   } else { ?>
                                                    <button title="You can't delete category having a post!" name="delete_category" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                                <?php   }
                                                ?>

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
        </main>

        <?php require_once('./includes/footer.php'); ?>