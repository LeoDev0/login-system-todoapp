const deleteBtn = document.querySelector(".delete-account-btn");

deleteBtn.onclick = () => {
  let deletar = confirm(
    "Tem certeza que deseja apagar esta conta e todos os dados contidos nela? Essa ação é irreversível!"
  );

  // Se o usuário der "Cancel", impede o envio da confirmação, se der "Ok", confirma a deleção e envia pro servidor
  if (deletar == false) {
    return false;
  }
};
