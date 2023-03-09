// Troca um HTMLDOMNode por outro.
const switchNodes = (nodeId, otherNodeId) => {
	document.getElementById(nodeId).classList.toggle("hidden");
	document.getElementById(otherNodeId).classList.toggle("hidden");
};

// Troca tipos email por text
const switchPasswordInputs = (inputId, otherInputId) => {
	const input = document.getElementById(inputId);
	const otherInput = document.getElementById(otherInputId);

	change(input);
	if (otherInput) change(otherInput);
};

const change = (i) => {
	const types = ["text", "password"];
	if (i.type == types[0]) i.type = types[1];
	else i.type = types[0];
};
