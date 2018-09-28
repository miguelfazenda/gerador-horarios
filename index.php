<?php
include 'include/index-logic.php'
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Gerador de horários</h1>

        <div class="form-inline">
            <div class="form-group mb-2">
                Ano letivo: 
            </div>
            <div class="form-group mb-2">
                <select class="form-control" id="termSelect">
                <option value="2018/2019">2018/2019</option>
                </select>
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group mb-2">
                Curso: 
            </div>
            <div class="form-group mb-2">
                <select class="form-control" id="degreeSelect" onchange="degreeSelectedEvent();">
                    <?php
                        /*foreach ($degrees as &$value) {
                            echo("<option value=\"" . $degree->id . "\">" . $value->acronym . " - " . $value->name . "</option>");
                        }*/
                    ?>
                    <option disabled selected value style="display:none"> -- Escolha um curso -- </option>
                    <option value="2761663971481">MEEC</option>
                    <option value="2761663971466">MEC</option>
                </select>
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group mb-2">
                Escolha a cadeira a adicionar: 
            </div>
            <div class="form-group mb-2">
                <select class="form-control" id="coursesSelect">
                </select>
            </div>
            <button type="button" class="btn btn-secondary mb-2" onclick="addCourse();">Adicionar</button>
        </div>
        
        

        <div id="app">
            <ul class="list-group list-group-flush">
                <li v-for="(course, index) in selectedCourses" class="list-group-item">
                    {{ course.acronym }} - {{ course.name }}  ({{ course.academicTerm }})<br>
                    <div v-for="load in course.loads" class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" v-model="load.checked">
                        <label class="form-check-label">{{ load.text }}&emsp;</label>
                    </div>
                    <button v-on:click="selectedCourses.splice(index, 1)" class="btn btn-outline-danger btn-sm">Remove</button>
                </li>
            </ul>
        </div>

        <button type="button" class="btn btn-primary" onclick="generateSchedules();">Gerar</button>

        <br><br><br><br>
        Este site serve para facilitar gerar horários, é baseado no <a href="http://web.ist.utl.pt/pedropramos/horarios/">gerador de horários compactos</a> criado pelo <a href="https://github.com/pedropramos">https://github.com/pedropramos</a> mas permite a seleção de unidades curriculares de forma mais simples.
        Quando se escolhe as UCs, um horário é gerado pelo gerador do pedropramos
        <br><br>
        TODO: lista de cursos, dar erro quando nenhuma uc está selecionada
    </div>
    

    <script>
        //var courseList = <?/*=json_encode($courses);*/?>
    </script>

    <script src="a.js"></script>
</body>
</html>