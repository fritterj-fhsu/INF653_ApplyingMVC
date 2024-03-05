<?php
function get_categories()
{
    global $pdo;
    $query = 'SELECT * FROM categories ORDER BY categoryID';
    $statement = $pdo->query($query);
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $categories;
}

function get_category_name($category_id)
{
    global $pdo;
    $query = 'SELECT categoryName FROM categories WHERE categoryID = :categoryID';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':categoryID', $category_id, PDO::PARAM_INT);
    $statement->execute();
    $category = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $category ? $category['categoryName'] : null;
}

function add_category($categoryName)
{
    global $pdo;
    $count = 0;
    $query = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':categoryName', $categoryName);
    
    if ($statement->execute()) {
        $count = $statement->rowCount();
    }
    
    $statement->closeCursor();
    return $count;
}

function delete_category($categoryID)
{
    global $pdo;
    $count = 0;
    $query = 'DELETE FROM categories WHERE categoryID = :categoryID';
    $statement = $pdo->prepare($query);
    $statement->bindValue(":categoryID", $categoryID, PDO::PARAM_INT);

    if ($statement->execute()) {
        $count = $statement->rowCount();
    }

    $statement->closeCursor();
    return $count;
}
?>