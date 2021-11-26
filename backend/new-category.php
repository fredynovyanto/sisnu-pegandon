<?php 
$title_page = "New Category";
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
                if (isset($_POST['submit'])) {
                    $category_name = trim($_POST['category_name']);
                    $category_status = $_POST['category_status'];
                    $sql = "INSERT INTO categories (category_name, category_status, created_on, created_by) 
                            VALUES (:cat_name, :cat_status, :created_on, :created_by)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':cat_name' => $category_name,
                        ':cat_status' => $category_status,
                        ':created_on' => date('D, d-M-Y / H:i:s a'),
                        ':created_by' => $_SESSION['user_name']
                    ]);
                    header("Location: categories.php");
                }
            ?>
            <!--Start Table-->
            <div class="container-fluid mt-n10">
                <div class="card mb-4">
                    <div class="card-header">Create New Category</div>
                    <div class="card-body">
                        <form action="new-category.php" method="POST">
                            <div class="form-group">
                                <label for="post-title">Category Name:</label>
                                <input name="category_name" class="form-control" id="post-title" type="text" placeholder="Category Name..." required />
                            </div>
                            <div class="form-group">
                                <label for="post-status">Status:</label>
                                <select name="category_status" class="form-control" id="post-status">
                                    <option value="Published">Published</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                            <button name="submit" class="btn btn-primary mr-2 my-1" type="submit">Submit now</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--End Table-->
        </main>

        <?php require_once('./includes/footer.php'); ?>