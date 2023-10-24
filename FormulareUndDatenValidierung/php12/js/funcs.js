function validateDate(e) {
    let today = new Date();
    today.setHours(0, 0, 0, 0);

    let date = new Date(e.value);
    date.setHours(0, 0, 0, 0);

    if (date <= today) {
        e.classList.add("is-valid");
        e.classList.remove("is-invalid");
    } else {
        e.classList.add("is-invalid");
        e.classList.remove("is-valid");
    } 
}

let ampel;

function switchAmpel(weight, height) {
    height = (height > 3) ? height / 100 : height;
    const bmi = weight / (height * height);
    let img;
    if (bmi < 0) img = "images/ampel.png";
    else if (bmi < 18.5) img = "images/ampel_gelb.png";
    else if (bmi < 24.9) img = "images/ampel_gruen.png";
    else if (bmi < 29.9) img = "images/ampel_gelb.png";
    else img = "images/ampel_rot.png";
    ampel.attr("src", img);
}


$(document).ready(() => {
    const weightElem = $("input[name='weight']");
    const heightElem = $("input[name='height']");
    ampel = $('#ampel');

    const weight = parseFloat(weightElem.val());
    const height = parseFloat(heightElem.val());
    switchAmpel(weight, height);

    $(document).keyup(() => {
        const weight = parseFloat(weightElem.val());
        const height = parseFloat(heightElem.val());
        switchAmpel(weight, height);
    });
});
