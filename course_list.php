<?php
require_once('database.php');

// Get all courses
$query = 'SELECT * FROM sk_courses
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
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Course Manager</h1></header>
<main>
    <h1>Course List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        
        <!-- add code for the rest of the table here -->
        <?php foreach ($courses as $course) : ?>
            <tr>
                <td><?php echo $course['courseID']; ?></td>
                <td><?php echo $course['courseName']; ?></td>
            </tr>
        <?php endforeach; ?>
    
    </table>
    <p>
    <h2>Add course</h2>
    
    <!-- add code for the form here -->
    <form action="add_course.php" method="post" id="add_course_form">
      <table class="other">
       <tr>
          <td><label>Course Id:</label></td>
          <td><input type="text" name="course_id"></td>
       </tr>
       <tr>
           <td><label>Course Name:</label></td>
           <td><input type="text" name="course_name"></td>
       </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Add Course"></td>
       </tr>
     </table>
    </form>

    <br>
    <p><a href="index.php">List Students</a></p>

    </main>

    <footer>
    <p class='copyright'>&copy; <?php echo date("Y"); ?> Vladimir Heredia</p>
    </footer>
</body>
</html>