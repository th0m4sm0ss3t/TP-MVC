function toggle() {

    // Select the password field
    const passwordField = document.getElementById("passwordField");

    // Select the span
    const togglespan = document.querySelector(".togglespan");

    // On click : change the field's type to "text"
    // And display the "hide button"
    if (passwordField.type === "password") {
        passwordField.type = "text";

        togglespan.classList.remove("show-eye");
        togglespan.classList.add("hide-eye");

      // Else change the type to "password"
      // And display the "show button"  
    } else {
        passwordField.type = "password";

        togglespan.classList.add("show-eye");
        togglespan.classList.remove("hide-eye");
    }
}

function toggleconfirm() {

    // Select the password field
    const confirmPasswordField = document.getElementById("confirmPasswordField");
    // Select the span
    const togglespanconfirm = document.querySelector(".togglespanconfirm");

    // On click : change the field's type to "text"
    // And display the "hide button"

    if (confirmPasswordField.type === "password") {
        confirmPasswordField.type = "text";

        togglespanconfirm.classList.remove("show-eye");
        togglespanconfirm.classList.add("hide-eye");

      // Else change the type to "password"
      // And display the "show button"  
    } else {
        confirmPasswordField.type = "password";

        togglespanconfirm.classList.add("show-eye");
        togglespanconfirm.classList.remove("hide-eye");
    }
}

// DELETE_MODAL
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })