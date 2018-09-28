<?php
/* Returns the course Loads(what kind of classes exist), schedule...  */
$courseid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$json = file_get_contents('https://fenix.tecnico.ulisboa.pt/api/fenix/v1/courses/' . $courseid . "/schedule");
$course = json_decode($json);

header('Content-Type: application/json');
echo json_encode($course);

?>