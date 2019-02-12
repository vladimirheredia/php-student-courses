<?php
/**
 * Name: Vladimir Heredia
 * Date: 2/15/2018
 * Desc: This is where we add a new course to the database.
 */
// Get the course data
$course_id = filter_input(INPUT_POST, 'course_id');
$course_name = filter_input(INPUT_POST, 'course_name');

// Validate inputs
if ($course_name == null || $course_id == null) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the course to the database  
    $query = 'INSERT INTO sk_courses
                 (courseID, courseName)
              VALUES (:course_id, :course_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':course_name', $course_name);
    $statement->execute();
    $statement->closeCursor();

    // Display the course list page after it has been added to DB
    include('course_list.php');
}
?>