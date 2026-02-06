<?php
$pdo = new PDO("sqlite:../database.db");
$sort = filter_input(INPUT_GET, 'sort');
if ($sort === 'date') {
    $sql = "SELECT * FROM todos ORDER BY due_date";
} elseif ($sort === 'title') {
    $sql = "SELECT * FROM todos ORDER BY title";
} else {
    $sql = "SELECT * FROM todos";
}

$sql = $pdo->query($sql);

if ($sql) {
    $todos = $sql->fetchAll();
} else {
    $todos = [];
    $error = "Failed to retrieve todos.";
}

/**
 * Get the todos from the sqlite database, and display them in a list.
 * You need to add a sort query parameter to the page to order by date or name.
 * If the query parameter is not set, the todos should be displayed in the order they were added.
 * If the request to the database fails, display an error message.
 * If the user wants to delete a todo, a form that sends a POST request to the deleteTodoFromDatabase.php page should be displayed on each todo elements.
 * The sort option selected must be remembered after the form submission (use a query parameter).
 * The todo title and date should be displayed in a list (date in american format).
 */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List of todos</title>
</head>
<body>

<h1>
    All todos
</h1>

<p>
    Sort by: 
    <a href="displayAllTodosFromDatabase.php?sort=date">Date</a> | 
    <a href="displayAllTodosFromDatabase.php?sort=title">Title</a>
</p>

<a href="writeTodoToDatabase.php">Ajouter une nouvelle todo</a>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>

<ul>   
    <?php foreach ($todos as $todo): ?>
    <li> 
        <?= htmlspecialchars($todo['title']) ?> (<?= date("m/d/Y", strtotime($todo['due_date'])) ?>)
        <form action="deleteTodoFromDatabase.php?sort=<?= htmlspecialchars($sort ?? '') ?>" method="POST" style="display:inline;">
            <input type="hidden" name="id" value="<?= $todo['id'] ?>">
            <button type="submit">Delete</button>
        </form>
    </li>
    <?php endforeach; ?>
</ul>
<!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->
</body>
</html>