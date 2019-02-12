<?php
/**
 * Name: Vladimir Heredia
 * Date: 2/15/2018
 * Desc: This is the form we use to add a new course, but we also show the list of courses in this page.
 */
require('database.php');
$query = 'SELECT *
          FROM sk_courses
          ORDER BY courseID';
$statement = $db->prepare($query);
$statement->execute();
$courses = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Course Manager</title>
    <link rel="stylesheet" type="text/css" href="styles/main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Course Manager</h1></header>

    <main>
        <h1>Add Student</h1>
        <table class="other">
            <form action="add_student.php" method="post"
                id="add_student_form">
            <tr>
                <td>  <label>Course:</label> </td>
                <td>  <select name="course_id">
                    <?php foreach ($courses as $course) : ?>
                        <option value="<?php echo $course['courseID']?>">
                            <?php echo $course['courseID'] . " - " . $course['courseName']; ; ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td> <label>First Name:</label> </td>
                <td><input type="text" name="first_name" required></td>
           </tr>
           <tr>
               <td> <label>Last Name:</label> </td>
               <td> <input type="text" name="last_name" required></td>
           </tr>
           <tr>
                <td> <label>Email:</label> </td>
                <td> <input type="email" name="email" required placeholder="jdoe@example.com"></td>
           </tr>
           <tr>
                <td></td>
                <td> <input type="submit" value="Add Student"></td>
           </tr>
            </form>
        </table>
        <p><a href="index.php">View Student List</a></p>
    </main>

    <footer>
        <p class='copyright'>&copy; <?php echo date("Y"); ?> Vladimir Heredia</p>
    </footer>
</body>
</html>