const createType = async () => {
	const url = `/novo-tipo`;

	const type = prompt("Digite o novo tipo:");

	if (!type) {
		return;
	}

	try {
		const res = await fetch(url, {
			method: 'POST',
			headers: {"Content-Type": "application/json"},
			body: JSON.stringify({type})
		});

		if (!res.ok) {
			await res.json();
			alert(`Não foi possível cadastrar o tipo "${type}":\n${res.error}`);
			return;
		}

		location.reload();
	} catch (error) {
		alert(error.message);
	}
}

const newTypeButtons = document.querySelectorAll('.new-type-button');
newTypeButtons.forEach((btn) => {
	(btn.onclick = async (evt) => await createType());
});
