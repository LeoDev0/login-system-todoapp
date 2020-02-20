const inputSenha = document.querySelector("input[name='senha']");
const inputSenhaRepetida = document.querySelector(
  "input[name='senha-repetida']"
);
const signupForm = document.getElementById("signup-form");
const labelSenha = document.querySelectorAll(".form label::after");

signupForm.onsubmit = () => {
  if (inputSenha.value != inputSenhaRepetida.value) {
    alert("Senhas digitadas não são iguais!");
    // labelSenha.style.borderColor = "red";
    return false;
  }
};

alert("teste");

// labelSenha.style.borderBottom = "3px solid red";
