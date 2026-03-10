/* EDIT MODAL */

const editButtons = document.querySelectorAll(".edit-btn");
const modal = document.getElementById("editModal");

const idInput = document.getElementById("edit_id");
const nameInput = document.getElementById("edit_name");
const depInput = document.getElementById("edit_department");
const ageInput = document.getElementById("edit_age");

const closeModal = document.getElementById("closeModal");

editButtons.forEach(btn => {

    btn.addEventListener("click", () => {

        modal.style.display = "flex";

        idInput.value = btn.dataset.id;
        nameInput.value = btn.dataset.name;
        depInput.value = btn.dataset.department;
        ageInput.value = btn.dataset.age;

    });

});

closeModal.addEventListener("click", () => {

    modal.style.display = "none";

});

/* CLOSE MODAL IF CLICK OUTSIDE */

window.addEventListener("click", (e) => {

    if (e.target === modal) {
        modal.style.display = "none";
    }

});