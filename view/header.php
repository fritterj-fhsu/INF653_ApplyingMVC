<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Fritter - Applying MVC Assignment</title>
    <link rel="stylesheet" type="text/css" href="view/css/main.css">
</head>

<body>
    <main>
        <header>
            <h1>ToDo List!!!!</h1>
            <nav>
                <form method="post" action="">
                    <button type="submit" name="view" value="todoItems" <?php echo isset($_POST['view']) && $_POST['view'] === 'todoItems' ? 'class="selected-tab"' : ''; ?>>Todo Items</button>
                </form>
                <form method="post" action="">
                    <button type="submit" name="view" value="categories" <?php echo isset($_POST['view']) && $_POST['view'] === 'categories' ? 'class="selected-tab"' : ''; ?>>Categories</button>
                </form>
            </nav>
        </header>