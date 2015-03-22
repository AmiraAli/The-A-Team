$(document).ready(function () {
    $('#addMaterial_btn').click(function () {
        $('#addMateriaForm').slideToggle();
    });
});

/**
 * function to check for join and unjoin button
 * @returns {undefined}
 */
function Join(user_id, course_id) {
    var btn = document.getElementById("join");

    if (btn.innerHTML === "Join Course") {


        //open http request to send the parameters of user and course to join
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "../../../../public/Courses/join/", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("userid=" + user_id + "&courseid=" + course_id);

        //on change check even the request send or not


        xmlhttp.onreadystatechange = function () {


            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            }
            console.log(xmlhttp.responseText);
            btn.innerHTML = "UnJoin Course";
        };

    } else {
        //open http request to send the parameters of user and course to join
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "../../../../public/Courses/unjoin/", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("userid=" + user_id + "&courseid=" + course_id);

        //on change check even the request send or not


        xmlhttp.onreadystatechange = function () {


            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            }
            console.log(xmlhttp.responseText);
            btn.innerHTML = "Join Course";
        };
    }

}

            