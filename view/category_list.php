<body>

    <?php
        echo "<table>";
        echo "<thead><tr><th>Category</th><th class='action-column'>Action</th></tr></thead>";
        echo "<tbody>";

        foreach ($categories as $category) {
            echo "<tr>";
            echo "<td>{$category['categoryName']}</td>";
            echo "<td>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='removeCategory' value='{$category['categoryID']}'>";
            echo "<button type='submit' name='action' value='deleteCategory'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        echo "<tr>";
        echo "<form method='post' action=''>";
        echo "<td><input type='text' name='newCategory' required></td>";
        echo "<td><button type='submit' name='action' value='addCategory'>Add Category</button></td>";
        echo "</form>";
        echo "</tr>";

        echo "</tbody></table>";
    ?>

</body>
