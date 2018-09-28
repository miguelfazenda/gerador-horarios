<?php
/* Returns info such as the course name, url... */
$courseid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$json = file_get_contents('https://fenix.tecnico.ulisboa.pt/api/fenix/v1/courses/' . $courseid);
$course = json_decode($json);

header('Content-Type: application/json');
echo json_encode($course);

?>