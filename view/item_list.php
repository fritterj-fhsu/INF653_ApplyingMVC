<body>
    <form method="post" action="">
        <label for="categoryFilter">Filter by Category:</label>
        <select name="categoryFilter" id="categoryFilter">
            <option value="all" <?php echo isset($_POST['categoryFilter']) && $_POST['categoryFilter'] === 'all' ? 'selected' : ''; ?>>All</option>
            <?php
            foreach ($categories as $category) {
                echo "<option value='{$category['categoryID']}' " . (isset($_POST['categoryFilter']) && $_POST['categoryFilter'] == $category['categoryID'] ? 'selected' : '') . ">{$category['categoryName']}</option>";
            }
            ?>
        </select>
        <button type="submit">Apply Filter</button>
    </form>

    <?php
    echo "<table>";
    echo "<thead><tr><th class='title-column'>Title</th><th>Description</th><th class='category-column'>Category</th><th class='action-column'>Action</th></tr></thead>";
    echo "<tbody>";

    foreach ($todoItems as $item) {
        if (!isset($_POST['categoryFilter']) || $_POST['categoryFilter'] == 'all' || $item['categoryID'] == $_POST['categoryFilter']) {
            echo "<tr>";
            echo "<td>{$item['Title']}</td>";
            echo "<td>{$item['Description']}</td>";
            echo "<td>{$item['categoryName']}</td>";
            echo "<td>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='remove' value='{$item['ItemNum']}'>";
            echo "<button type='submit' name='action' value='delete'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    }

    echo "<tr>";
    echo "<form method='post' action=''>";
    echo "<td><input type='text' name='newTitle' required></td>";
    echo "<td><input type='text' name='newDescription' required></td>";
    echo "<td>
            <select name='categoryID'>
                <option value='' selected>Select a category</option>";
    foreach ($categories as $category) {
        echo "<option value='{$category['categoryID']}'>{$category['categoryName']}</option>";
    }
    echo "</select>
        </td>";
    echo "<td><button type='submit' name='action' value='insert'>Add Item</button></td>";
    echo "</form>";
    echo "</tr>";

    echo "</tbody></table>";
    ?>
</body>
