<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Add Main Category
if (isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $select_categories = $conn->prepare("SELECT * FROM `categories` WHERE name = ?");
    $select_categories->execute([$name]);

    if ($select_categories->rowCount() > 0) {
        $message[] = 'Category name already exists!';
    } else {
        $insert_category = $conn->prepare("INSERT INTO `categories`(name) VALUES(?)");
        $insert_category->execute([$name]);

        if ($insert_category) {
            $message[] = 'New category added!';
        }
    }
}

// Add Subcategory
if (isset($_POST['add_subcategory'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $main_category_id = $_POST['main_category_id'];

    $select_subcategories = $conn->prepare("SELECT * FROM `subcategories` WHERE name = ? AND main_category_id = ?");
    $select_subcategories->execute([$name, $main_category_id]);

    if ($select_subcategories->rowCount() > 0) {
        $message[] = 'Subcategory already exists under this main category!';
    } else {
        $insert_subcategory = $conn->prepare("INSERT INTO `subcategories`(name, main_category_id) VALUES(?, ?)");
        $insert_subcategory->execute([$name, $main_category_id]);

        if ($insert_subcategory) {
            $message[] = 'New subcategory added!';
        }
    }
}

// Update Main Category
if (isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $update_category = $conn->prepare("UPDATE `categories` SET name = ? WHERE id = ?");
    $update_category->execute([$name, $category_id]);

    $message[] = 'Category updated successfully!';
}

// Update Subcategory
if (isset($_POST['update_subcategory'])) {
    $subcategory_id = $_POST['subcategory_id'];
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $main_category_id = $_POST['main_category_id'];

    $update_subcategory = $conn->prepare("UPDATE `subcategories` SET name = ?, main_category_id = ? WHERE id = ?");
    $update_subcategory->execute([$name, $main_category_id, $subcategory_id]);

    $message[] = 'Subcategory updated successfully!';
}


// Delete Main Category
if (isset($_GET['delete_category'])) {
    $delete_id = $_GET['delete_category'];
    $delete_category = $conn->prepare("DELETE FROM `categories` WHERE id = ?");
    $delete_category->execute([$delete_id]);

    // Optional: Delete related subcategories if any
    $delete_related_subcategories = $conn->prepare("DELETE FROM `subcategories` WHERE main_category_id = ?");
    $delete_related_subcategories->execute([$delete_id]);

    header('location:category.php'); // Ensure the correct file name
    exit;
}

// Delete Subcategory
if (isset($_GET['delete_subcategory'])) {
    $delete_id = $_GET['delete_subcategory'];
    $delete_subcategory = $conn->prepare("DELETE FROM `subcategories` WHERE id = ?");
    $delete_subcategory->execute([$delete_id]);

    header('location:category.php'); // Ensure the correct file name
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

    <?php include '../components/admin_header.php'; ?>

    <div class="two-category">
        <section class="add-category">

            <h1 class="heading">Add Main Category</h1>

            <form action="" method="post">
                <div class="inputBox">
                    <span>Main Category Name (required)</span>
                    <input type="text" class="box" required maxlength="100" placeholder="Enter category name"
                        name="name">
                </div>
                <input type="submit" value="Add Category" class="btn" name="add_category">
            </form>

        </section>

        <section class="add-subcategory">

            <h1 class="heading">Add Subcategory</h1>

            <form action="" method="post">
                <div class="inputBox">
                    <span>Subcategory Name (required)</span>
                    <input type="text" class="box" required maxlength="100" placeholder="Enter subcategory name"
                        name="name">
                </div>
                <div class="inputBox">
                    <span>Select Main Category (required)</span>
                    <select name="main_category_id" class="box" required>
                        <option value="" disabled selected>Choose main category</option>
                        <?php
                        $select_categories = $conn->prepare("SELECT * FROM `categories`");
                        $select_categories->execute();
                        if ($select_categories->rowCount() > 0) {
                            while ($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $fetch_categories['id'] . '">' . $fetch_categories['name'] . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>No categories available</option>';
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" value="Add Subcategory" class="btn" name="add_subcategory">
            </form>

        </section>
    </div>


    <section class="show-categories">

        <h1 class="heading">Manage Categories</h1>

        <div class="box-container">

            <!-- Main Categories Table -->

            <table class="table">
                <thead>
                    <tr>
                        <th>Main Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_categories = $conn->prepare("SELECT * FROM `categories`");
                    $select_categories->execute();
                    if ($select_categories->rowCount() > 0) {
                        while ($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= $fetch_categories['name']; ?></td>
                                <td>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="category_id" value="<?= $fetch_categories['id']; ?>">
                                        <input type="text" name="name" class="box" value="<?= $fetch_categories['name']; ?>"
                                            required>
                                        <input type="submit" value="Update" class="option-btn" name="update_category">
                                    </form>
                                    <a href="category.php?delete_category=<?= $fetch_categories['id']; ?>" class="delete-btn"
                                        onclick="return confirm('Delete this category?');">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="2" class="empty">No categories added yet!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <!-- Subcategories Table -->

            <table class="table">
                <thead>
                    <tr>
                        <th>Subcategory Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_subcategories = $conn->prepare("SELECT subcategories.*, categories.name AS main_category_name FROM `subcategories` JOIN `categories` ON subcategories.main_category_id = categories.id");
                    $select_subcategories->execute();
                    if ($select_subcategories->rowCount() > 0) {
                        while ($fetch_subcategories = $select_subcategories->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?= $fetch_subcategories['name']; ?> (<?= $fetch_subcategories['main_category_name']; ?>)
                                </td>
                                <td>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="subcategory_id" value="<?= $fetch_subcategories['id']; ?>">
                                        <input type="text" name="name" class="box" value="<?= $fetch_subcategories['name']; ?>"
                                            required>
                                        <select name="main_category_id" class="box" required>
                                            <?php
                                            $categories = $conn->prepare("SELECT * FROM `categories`");
                                            $categories->execute();
                                            while ($category = $categories->fetch(PDO::FETCH_ASSOC)) {
                                                $selected = $category['id'] == $fetch_subcategories['main_category_id'] ? 'selected' : '';
                                                echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <input type="submit" value="Update" class="option-btn" name="update_subcategory">
                                    </form>
                                    <a href="category.php?delete_subcategory=<?= $fetch_subcategories['id']; ?>"
                                        class="delete-btn" onclick="return confirm('Delete this subcategory?');">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="2" class="empty">No subcategories added yet!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </section>


    <script src="../js/admin_script.js"></script>

</body>

</html>