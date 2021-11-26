<?php
$title_page = "Edit Category";
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
                            <span>Create New Category</span>
                        </h1>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['edit'])) {
                $id = $_POST['edit-id'];
                $url = "http://localhost/sisnu-pegandon/backend/edit-category.php?id=" . $id;
                header("Location: {$url}");
            }
            ?>
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Create New Category</div>
                    <div class="card-body">
                        <?php
                        $sql = "SELECT * FROM categories WHERE category_id = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':id' => $_GET['id']
                        ]);
                        $categories = $stmt->fetch(PDO::FETCH_ASSOC);
                        $category_name = $categories['category_name'];
                        $category_status = $categories['category_status'];
                        ?>
                        <?php 
                            if (isset($_POST['update'])) {
                                $category_name = trim($_POST['category_name']);
                                $category_status = $_POST['category_status'];
                                $sql = "UPDATE categories SET category_name = :name, category_status = :status WHERE category_id = :id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':name' => $category_name,
                                    ':status' => $category_status,
                                    ':id' => $_GET['id']
                                ]);
                                header("Location: categories.php");
                            }
                        ?>
                        <form action="edit-category.php?id=<?= $_GET['id']?>" method="POST">
                            <div class="form-group">
                                <label for="post-title">Category Name:</label>
                                <input name="category_name" value="<?= $category_name ?>" class="form-control" id="post-title" type="text" placeholder="Category Name..." />
                            </div>
                            <div class="form-group">
                                <label for="post-status">Status:</label>
                                <select name="category_status" class="form-control" id="post-status">
                                    <option value="Published" <?= $category_status == 'Published' ? 'selected' : ''; ?>>Published</option>
                                    <option value="Draft" <?= $category_status == 'Draft' ? 'selected' : ''; ?>>Draft</option>
                                </select>
                            </div>
                            <button name="update" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Table-->
        </main>

        <?php require_once('./includes/footer.php'); ?>