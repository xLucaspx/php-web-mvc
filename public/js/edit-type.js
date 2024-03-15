const editType = async (id, type) => {
	const url = `/editar-tipo`;

	const newName = prompt(`Digite o novo nome para o tipo "${type}"`, type);

	if (!newName || newName === type) {
		alert("Valor inválido!");
		return;
	}

	try {
		const res = await fetch(url, {
			method: 'PUT',
			headers: {"Content-Type": "application/json"},
			body: JSON.stringify({id, type: newName})
		});

		if (!res.ok) {
			await res.json();
			alert(`Não foi possível atualizar o tipo "${type}":\n${res.error}`);
			return;
		}

		location.reload();
	} catch (error) {
		alert(error.message);
	}
}

const editButtons = document.querySelectorAll('.edit-type-button');
editButtons.forEach((btn) => {
	(btn.onclick = async (evt) => await editType(btn.dataset.id, btn.dataset.type));
});
