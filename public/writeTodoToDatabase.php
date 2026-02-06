<?php
$title = filter_input(INPUT_POST, 'name');
$date = filter_input(INPUT_POST, 'date');
$pdo = new PDO("sqlite:../database.db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (strlen($title) > 5 && !empty($date)) {
        $sql = $pdo->prepare("INSERT INTO todos (title , due_date ) VALUES (:title, :due_date)");
        $sql->execute([
            ':title' => $title,
            ':due_date' => $date
        ]);
        header("Location: displayAllTodosFromDatabase.php");
        exit();
    } else {
        $error = "invalid title or date";
    }
}
/**
 * On this page, you will create a simple form that allows user to create todos (with a name and a date).
 * The form should be submitted to this PHP page.
 * Then get the inputs from the post request with `filter_input`.
 * Then, the PHP code should verify the user inputs (minimum length, valid date...)
 * If the user input is valid, insert the new todo information in the sqlite database
 * table `todos` columns `title` and `due_date`. Then redirect the user to the list of todos.
 * If the user input is invalid, display an error to the user
 */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a new todo</title>
</head>
<body>

<form method="POST">
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <label for="title">Title:</label>
    <input type="text" id="title" name="name" value="<?= htmlspecialchars($title ?? '') ?>">
    
    <label for="due_date">Date:</label>
    <input type="date" id="due_date" name="date" value="<?= htmlspecialchars($date ?? '') ?>">
    
    <button type="submit">Submit</button>
</form>
<!-- WRITE YOUR HTML AND PHP TEMPLATING HERE -->
</body>
</html>