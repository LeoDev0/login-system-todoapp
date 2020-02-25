const changePhotoBtn = document.getElementById("change-photo-btn");
const submitPhotoElem = document.querySelector(".submit-profile-photo");

// Ao clicar no elemento com a foto do perfil, um outro evento de clique
// é iniciado no elemento de envio de arquivos que está escondido na barra de navegação
changePhotoBtn.onclick = () => {
  submitPhotoElem.click();
};

// const oldPassInput = document.querySelector("input[name='old-pass']");
const newPassInput = document.querySelector("input[name='new-pass']");
const repeatNewPassInput = document.querySelector(
  "input[name='repeat-new-pass']"
);
const changePassForm = document.getElementById("pass-change-form");

// Checa se a senha foi digitada corretamente nos dois campos da nova senha
changePassForm.onsubmit = () => {
  let passValue = newPassInput.value;
  let repeatPassValue = repeatNewPassInput.value;

  if (passValue !== repeatPassValue) {
    alert("Senhas digitadas são diferentes!");
    return false;
  }
};
