<?php

    //connection to the DB
    require_once('database.php');

    $format_type = filter_input(INPUT_GET, 'format');
    $action = filter_input(INPUT_GET, 'action');
    $course_id = filter_input(INPUT_GET, 'course');

    //courses node
    $courses_node = 'courses';
    $course_node = "course";

    //root element
    $doc = new DOMDocument('1.0');
    $doc->preserveWhiteSpace = false;

    $doc->formatOutput = true;
 
    //student nodes
    $students_node = 'students';
    $student_node = 'student';
   

    // Get all courses
    $query = 'SELECT * FROM sk_courses
    ORDER BY courseID';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    //rest.php?format=json&action=courses
    if($format_type == "json" && $action == "courses"){
        //print all courses in json format
        echo json_encode($courses);
    }
    elseif($format_type == "xml" && $action == "courses"){
        //create courses node
        $crs_node = $doc->createElement($courses_node);
        $crs_node = $doc->appendChild($crs_node);
        //loop through to create course node
        foreach($courses as $value){
            $cr_node = $doc->createElement($course_node);
            $cr_node = $crs_node->appendChild($cr_node);
            $cs_id = $doc->createElement("courseID", $value['courseID']);
            $cs_name = $doc->createElement("courseName", $value['courseName']);
            $cr_node->appendChild($cs_id);
            $cr_node->appendChild($cs_name);
        }
        echo "<pre>" . htmlentities($doc->saveXML()) . "<pre>";
    }

     // Get students for selected course
     $queryStudents = 'SELECT * FROM sk_students
     WHERE courseID = :course_id
     ORDER BY studentID';
     $statement3 = $db->prepare($queryStudents);
     $statement3->bindValue(':course_id', $course_id);
     $statement3->execute();
     $students = $statement3->fetchAll(PDO::FETCH_ASSOC);
     $statement3->closeCursor();

    //rest.php?format=format_type&action=students&course=cs502
    if($format_type == "json" && $action == "students" && $course_id != null){
        //print all students based on courseID
        echo json_encode($students);
    }
    elseif($format_type == "xml" && $action == "students" && $course_id != null){
        //create students node
        $stds_node = $doc->createElement($students_node);
        $stds_node = $doc->appendChild($stds_node);
        //loop through to create student node
        foreach($students as $student){
            $std_node = $doc->createElement($student_node);
            $std_node = $stds_node->appendChild($std_node);
            $std_id = $doc->createElement("courseID", $student['courseID']);
            $std_firstName = $doc->createElement('firstName', $student['firstName']);
            $std_lastName = $doc->createElement('lastName', $student['lastName']);
            $std_email = $doc->createElement('email', $student['email']);
            $std_node->appendChild($std_id);
            $std_node->appendChild($std_firstName);
            $std_node->appendChild($std_lastName);
            $std_node->appendChild($std_email);
        }
        echo "<pre>" . htmlentities($doc->saveXML()) . "<pre>";
    }
    
?>