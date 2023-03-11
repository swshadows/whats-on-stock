// Troca um HTMLDOMNode por outro.
const switchNodes = (nodeId, otherNodeId) => {
	document.getElementById(nodeId).classList.toggle("hidden");
	document.getElementById(otherNodeId).classList.toggle("hidden");
};

// Troca tipos email por text
const switchPasswordInputs = (...inputIds) => {
	if (inputIds) {
		inputIds.forEach((inputId) => {
			const input = document.getElementById(inputId);
			change(input);
		});
	}
};

const change = (i) => {
	const types = ["text", "password"];
	if (i.type == types[0]) i.type = types[1];
	else i.type = types[0];
};
