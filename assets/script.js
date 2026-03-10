const form = document.getElementById("crudForm");
const alertBox = document.getElementById("alert");

form.addEventListener("submit", function (e) {

    e.preventDefault();

    showAlert("Form submitted. Connect to database to store data.");

    animateButton();

});

/* ALERT MESSAGE */

function showAlert(message) {

    alertBox.textContent = message;
    alertBox.classList.remove("hidden");

    setTimeout(() => {
        alertBox.classList.add("hidden");
    }, 3000);

}

/* BUTTON ANIMATION */

function animateButton() {

    const btn = document.querySelector(".submit-btn");

    btn.style.transform = "scale(0.95)";

    setTimeout(() => {
        btn.style.transform = "scale(1)";
    }, 150);

}

/* TABLE ROW ANIMATION (for when you add rows dynamically later) */

function addRowAnimation(row) {

    row.style.opacity = "0";
    row.style.transform = "translateY(10px)";

    setTimeout(() => {
        row.style.transition = "0.3s";
        row.style.opacity = "1";
        row.style.transform = "translateY(0)";
    }, 10);

}