<?php
require_once('database.php');

// Get IDs
$course_id = filter_input(INPUT_POST, 'course_id');
$student_id = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);

// Delete the course from the database
if ($course_id != false && $student_id != false) {
    $query = 'DELETE FROM sk_students
              WHERE studentID = :student_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':student_id', $student_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Course Management page
include('index.php');