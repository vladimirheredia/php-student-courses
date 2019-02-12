<?php
/**
 * Name: Vladimir Heredia
 * Date: 2/15/2018
 * Desc: This is where we add a new student to the database.
 */
// Get the student data
$course_id = filter_input(INPUT_POST, 'course_id');
$first_name = filter_input(INPUT_POST, 'first_name');
$last_name = filter_input(INPUT_POST, 'last_name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

// Validate inputs
if ($course_id == null || $course_id == false ||
        $first_name == null || $last_name == null || $email == null) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the student to the database  
    $query = 'INSERT INTO sk_students(courseID, firstName, lastName, email)
              VALUES(:course_id, :first_name, :last_name, :email)';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $statement->closeCursor();

    // Display the Student List page
    include('index.php');
}
?>