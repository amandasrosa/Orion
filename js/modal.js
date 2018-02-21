var modal = document.getElementById('deleteConfirmationModal');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function createModal(event, confirmation, message, okFunctionParam, okFunction) {
    event.preventDefault();

    modal = document.createElement("div");
    modal.id = "deleteConfirmationModal";
    modal.classList.add("modal");

    var modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");
    modal.appendChild(modalContent);

    var modalHeader = document.createElement("div");
    modalHeader.classList.add("modal-header");

    var title = document.createElement("p");
    title.textContent = "Delete";
    modalHeader.appendChild(title);

    modalContent.appendChild(modalHeader);

    var messageLineOne = document.createElement("p");
    messageLineOne.textContent = confirmation;
    modalContent.appendChild(messageLineOne);

    var messageLineTwo = document.createElement("p");
    messageLineTwo.textContent = message;
    modalContent.appendChild(messageLineTwo);

    var cancelButton = document.createElement("button");
    cancelButton.id = "cancelModal";
    cancelButton.type = "submit";
    cancelButton.textContent = "Cancel";
    cancelButton.classList.add("btn-basic");

    var okButton = document.createElement("button");
    okButton.id = "okModal";
    okButton.type = "submit";
    okButton.textContent = "Ok";
    okButton.classList.add("btn-basic");

    modalContent.appendChild(cancelButton);
    modalContent.appendChild(okButton);

    cancelButton.addEventListener("click", function (event) {
        event.preventDefault();
        modal.style.display = "none";
    });

    function ok() {
        okFunction(okFunctionParam);
        modal.style.display = "none";
    }

    okButton.addEventListener("click", ok);

    modal.style.display = "block";

    document.body.appendChild(modal);
}
