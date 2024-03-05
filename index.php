<?php
require("model/database.php");
require("model/todoitems_db.php");
require("model/categories_db.php");

include("view/header.php");

$categories = get_categories();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

    switch ($action) {
        case 'insert':
            $newTitle = filter_input(INPUT_POST, 'newTitle', FILTER_SANITIZE_SPECIAL_CHARS);
            $newDescription = filter_input(INPUT_POST, 'newDescription', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);

            if ($newTitle && $newDescription && $categoryID) {
                insert_todoitem($newTitle, $newDescription, $categoryID);
                $todoItems = select_todoitems();
                include("view/item_list.php");
            }
            break;

        case 'delete':
            $removeItemNum = filter_input(INPUT_POST, 'remove', FILTER_VALIDATE_INT);

            if ($removeItemNum) {
                delete_todoitem($removeItemNum);
                $todoItems = select_todoitems();
                include("view/item_list.php");
            }
            break;
        case 'deleteCategory':
            $removeCategoryID = filter_input(INPUT_POST, 'removeCategory', FILTER_VALIDATE_INT);

            if ($removeCategoryID) {
                delete_category($removeCategoryID);
                $categories = get_categories();
                include("view/category_list.php");
            }
            break;

        case 'addCategory':
            $newCategoryName = filter_input(INPUT_POST, 'newCategory', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($newCategoryName) {
                add_category($newCategoryName);
                $categories = get_categories();
                include("view/category_list.php");
            }
            break;
        default:
            break;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view'])) {
    $selectedView = filter_input(INPUT_POST, 'view', FILTER_SANITIZE_SPECIAL_CHARS);

    switch ($selectedView) {
        case 'todoItems':
            $todoItems = select_todoitems();
            include("view/item_list.php");
            break;

        case 'categories':
            $categories = get_categories();
            include("view/category_list.php");
            break;

        default:
            break;
    }
} else {
    $todoItems = select_todoitems();
    $categories = get_categories();
    include("view/item_list.php");
}

include("view/footer.php");
?>