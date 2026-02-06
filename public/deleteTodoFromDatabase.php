<?php
$pdo = new PDO("sqlite:../database.db");
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$sort = filter_input(INPUT_GET, 'sort');

if ($id) {
    $sql = $pdo->prepare("DELETE FROM todos WHERE id = :id");
    if ($sql->execute([':id' => $id])) {
        $url = "displayAllTodosFromDatabase.php" . ($sort ? "?sort=$sort" : "");
        header("Location: $url");
        exit();
    } else {
        $error = "Failed to delete the todo.";
    }
} else {
    $error = "Invalid ID.";
}
/**
 * On this page, you need to remove a todo from the sqlite database.
 * The id of the todo to delete will be passed as a POST parameter.
 * You need to handle the deletion of the todo from the database.
 * If there is an error, display an error message.
 * If the deletion is successful, redirect the user to the list of todos.
 */

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo deletion</title>
</head>
<body>

<h1>Delete a todo error</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
<!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->

<a href="displayAllTodosFromDatabase.php">Return to todo list</a>

</body>
</html>
