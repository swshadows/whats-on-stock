// Troca um HTMLDOMNode por outro.
const switchNodes = (nodeId, otherNodeId) => {
	document.querySelector(`#${nodeId}`).classList.toggle("hidden");
	document.querySelector(`#${otherNodeId}`).classList.toggle("hidden");
};

// Troca tipos password por text
const switchPasswordInputs = (...inputIds) => {
	if (inputIds) {
		inputIds.forEach((inputId) => {
			const input = document.querySelector(`#${inputId}`);
			change(input);
		});
	}
};

const change = (i) => {
	const types = ["text", "password"];
	if (i.type == types[0]) i.type = types[1];
	else i.type = types[0];
};

// Confirma a deleção de dados de um formulário
const confirmFormSend = (form, event) => {
	event.preventDefault();
	const confirmation = confirm(
		"🚮 Deseja realmente apagar sua conta?\n ⚠ AVISO: Essa ação é irreversível"
	);
	if (confirmation) {
		form.submit();
	}
};

// Esconde o componente de mensagem
const messageComponent = document.querySelector(".message");
if (messageComponent) {
	setTimeout(() => {
		messageComponent.classList.add("message-hidden");
		setTimeout(() => messageComponent.remove(), 400);
	}, 3000);
}

// Esconde ou mostra modal
const toggleModal = (modalId) => {
	const modal = document.querySelector(`#${modalId}`);
	modal.classList.toggle("hidden");
};
