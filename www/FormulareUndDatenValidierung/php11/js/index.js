
function validateExamDate(elem) {

    //alert("Hallo Welt!");
    //console.log(elem);

    let today = new Date();
    today.setHours(0, 0, 0, 0);

    // elem muss in ein Datum umgewandelt werden, damit es mit dem heutigen Datum verglichen werden kann
    let examDate = new Date(elem.value);
    examDate.setHours(0, 0, 0, 0); // nur das Datum ohne Zeit
    //console.log(examDate);

    if (examDate <= today) {
        elem.classList.add("is-valid");
        elem.classList.remove("is-invalid");
    } else {
        elem.classList.add("is-invalid");
        elem.classList.remove("is-valid");
    } 
}