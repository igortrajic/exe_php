<?php
$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$isSubmitted = !empty($name) && !empty($age);
/**
 * On this page, you should display a form with two fields, one for the Name and one for the Age.
 * The server should respond to the form submission by displaying the same page with the name and age in a h1 "Toto is 20 years old".
 * If there is no submission or only one of the two fields, the h1 should display "Submit the form".
 * If the user have a name with more than 6 characters, the name must be displayed in red (only the name, not all h1).
 * If the user is more than 18 years old, you should display a list with one line per year of the age of the user.
 * The data submitted should remain displayed in the form after the submission.
 * (Your form should be semantically correct, use a label and name your fields)
 */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form management</title>
</head>
<body>
    <form method="POST"> <?php if ($isSubmitted): ?>
        <h1>
            <span style="<?php echo (strlen($name) > 6) ? 'color: red;' : '' ?>">
                <?php echo $name ?>
            </span> 
            is <?php echo $age ?> years old
        </h1>
        <?php if ($age > 18): ?>
        <ul>
        <?php for ($i = 1; $i <= $age; $i++): ?>
        <li><?php echo $i; ?></li>
        <?php endfor; ?>
        </ul>
        <?php endif; ?>
    <?php else: ?>
        <h1>Submit the form</h1>
    <?php endif; ?>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?= $name ?>">
    <label for="age">Age:</label>
    <input type="text" id="age" name="age" value="<?= $age ?>">
    <button type="submit">Submit</button>

    </form>
</body>
</html>