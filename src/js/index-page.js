const profilePhotoElem = document.querySelector(".profile-photo");
const submitPhotoElem = document.querySelectorAll(".submit-profile-photo")[0];
const btnSubmitPhotoElem = document.querySelectorAll(
  ".submit-profile-photo"
)[1];

// Ao clicar no elemento com a foto do perfil, um outro evento de clique
// é iniciado no elemento de envio de arquivos que está escondido na barra de navegação
profilePhotoElem.onclick = () => {
  submitPhotoElem.click();
  setTimeout(() => {
    btnSubmitPhotoElem.click();
  }, 10000);
};
