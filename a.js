var app = new Vue({
    el: '#app',
    data: {
        courses: []
    }
});

function getCourseURL(id)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "get-course.php?id=" + id, false);
    xmlHttp.send(null);
    return JSON.parse(xmlHttp.responseText).url;
}

function getCourseLoads(id)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "get-course-schedule.php?id=" + id, false);
    xmlHttp.send(null);
    return JSON.parse(xmlHttp.responseText).courseLoads;
}

var coursesSelect = document.getElementById("coursesSelect");

//Converts a load name to the letters that it corresponds to
// such as: PROBLEMS -> PB, TEORICA -> T
function courseLoadNameToLetter(name) {
    switch(name.toUpperCase()) {
        case "PROBLEMS":
            return "PB";
        case "TEORICA":
            return "T";
        case "LABORATORIAL":
            return "L";
        default:
            alert("Erro: tipo de aula desconhecido: " + name);
            break;
    }
}

function isCourseInList(id)
{
    for(i in app.courses)
    {
        if(app.courses[i].id == id)
        {
            return true;
        }
    }
    return false;
}

//When the add course button is pressed
// adds the selected course to the list
function addCourse()
{
    var courseId = coursesSelect.options[coursesSelect.selectedIndex].value;
    var course = courseList[courseId];

    if(isCourseInList(courseId)) {
        alert("A UC já está na lista");
        return;
    }

    course["url"] = getCourseURL(courseId);

    //Find what kind of classes the course has (PROBLEMS, TEORICA...)
    let loads = getCourseLoads(courseId);

    course["loads"] = [];
    for(i in loads)
    {
        let loadLetter = courseLoadNameToLetter(loads[i].type);
        course.loads.push({text: loads[i].type, value: loadLetter, checked: true});
    }

    app.courses.push(course);
}

//https://stackoverflow.com/a/38445519
function redirectPost(url, data) {
    var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = url;
    for (var name in data) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = data[name];
        form.appendChild(input);
    }
    form.submit();
}

function generateSchedules()
{
    let data = {};
    for(courseI in app.courses)
    {
        let course = app.courses[courseI];
        //Add the course URL
        data["course" + courseI] = course.url;

        //Add the course class types
        for(loadI in course.loads)
        {
            if(course.loads[loadI].checked) {
                data["course" + courseI + "type" + loadI] = course.loads[loadI].value;
            }
        }

    }
    redirectPost("http://web.ist.utl.pt/pedropramos/horarios/generate_timetables.php", data);
}