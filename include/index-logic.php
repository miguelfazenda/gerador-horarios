<?php
    function get_courses_for_degree($degree) {
        $json = file_get_contents('https://fenix.tecnico.ulisboa.pt/api/fenix/v1/degrees/' . $degree . '/courses?academicTerm=2018/2019');
        $courses = json_decode($json);

        $coursesById = array();

        foreach($courses as $course){
            $coursesById[$course->id] = $course;
        }
        return $coursesById;
    }
    function sort_courses($courses) {
        $sortArray = array();
        
        foreach($courses as $course){
            $sortArray[$course->acronym] = $course;
        }
        
        //var_dump($sortArray);
        sort($sortArray);

        return $sortArray;
    }
    
    $degree = filter_var($_GET['deg'], FILTER_SANITIZE_NUMBER_INT);

    $courses = get_courses_for_degree($degree);
    
    $courses_sorted = sort_courses($courses);
?>