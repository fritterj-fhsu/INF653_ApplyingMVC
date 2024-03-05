<?php
function select_todoitems()
{
    global $pdo;
    $query = 'SELECT todoitems.*, categories.categoryName
              FROM todoitems
              LEFT JOIN categories ON todoitems.categoryID = categories.categoryID
              ORDER BY ItemNum ASC';
    $statement = $pdo->query($query);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $results;
}

function select_todoItem($ItemNum)
{
    global $pdo;
    $query = 'SELECT todoitems.*, categories.categoryName
              FROM todoitems
              LEFT JOIN categories ON todoitems.categoryID = categories.categoryID
              WHERE ItemNum = :itemNum';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':itemNum', $ItemNum);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $result;
}

function select_todoitems_by_category($categoryID)
{
    global $pdo;
    
    if ($categoryID === null || $categoryID === false) {
        $query = 'SELECT todoitems.*, categories.categoryName
                  FROM todoitems
                  LEFT JOIN categories ON todoitems.categoryID = categories.categoryID
                  ORDER BY ItemNum ASC';
        $statement = $pdo->query($query);
    } else {
        $query = 'SELECT todoitems.*, categories.categoryName
                  FROM todoitems
                  LEFT JOIN categories ON todoitems.categoryID = categories.categoryID
                  WHERE todoitems.categoryID = :categoryID
                  ORDER BY ItemNum ASC';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':categoryID', $categoryID);
        $statement->execute();
    }

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $results;
}

function insert_todoitem($title, $description, $categoryID)
{
    global $pdo;
    $count = 0;
    $query = 'INSERT INTO todoitems (Title, Description, categoryID) VALUES (:title, :description, :categoryID)';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':categoryID', $categoryID);
    if ($statement->execute()) {
        $count = $statement->rowCount();
    }
    $statement->closeCursor();
    return $count;
}

function update_todoitem($itemNum, $title, $description, $categoryID)
{
    global $pdo;
    $count = 0;
    $query = 'UPDATE todoitems SET Title = :title, Description = :description, categoryID = :categoryID WHERE ItemNum = :itemNum';
    $statement = $pdo->prepare($query);
    $statement->bindValue(":itemNum", $itemNum);
    $statement->bindValue(":title", $title);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":categoryID", $categoryID);
    if ($statement->execute()) {
        $count = $statement->rowCount();
    }
    $statement->closeCursor();
    return $count;
}

function delete_todoitem($itemNum)
{
    global $pdo;
    $count = 0;
    $query = 'DELETE FROM todoitems WHERE ItemNum = :itemNum';
    $statement = $pdo->prepare($query);
    $statement->bindValue(":itemNum", $itemNum);
    if ($statement->execute()) {
        $count = $statement->rowCount();
    }
    $statement->closeCursor();
    return $count;
}
?>
