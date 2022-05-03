//Acces au DOM et on stock les elements grace leurs id

//les 2 bouttons

let btnAdminForm = document.getElementById("toggle-admin");
let btnUserForm = document.getElementById("toggle-user");

//recyup les 2 formulaires
let formAdmin = document.getElementById("form-admin");
let userForm = document.getElementById("form-user");

//Declencher un evenement au clic
btnAdminForm.addEventListener("click", () => {
    formAdmin.classList.toggle("show");
});

btnUserForm.addEventListener("click", () => {
    userForm.classList.toggle("show");
});

