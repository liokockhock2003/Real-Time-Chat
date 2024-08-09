//Select the input['password'] element and i element
const pswrdField = document.querySelector(".form .field input[type='password']"),
toggleBtn = document.querySelector(".form .field i");

toggleBtn.onclick = () => {
    toggleBtn.classList.toggle("active");
    if (pswrdField.type == "password") {
        pswrdField.type = "text";
    } else {
        pswrdField.type = "password";
    }
};
