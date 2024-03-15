const deleteType = async (id, type) => {
	const url = `/remover-tipo?id=${id}`;

	const deleteOk = confirm(`Tem certeza que deseja excluir o tipo "${type}"?`);

	if (!deleteOk) return;

	try {
		const res = await fetch(url, {
			method: 'DELETE', headers: {"Content-Type": "application/json"}
		});

		if (!res.ok) {
			const data = await res.json();
			alert(`Não foi possível excluir o tipo "${type}":\n${data.error}`);
			return;
		}

		location.reload();
	} catch (error) {
		alert(error.message);
	}
}

const deleteButtons = document.querySelectorAll('.delete-type-button');
deleteButtons.forEach((btn) => {
	(btn.onclick = async (evt) => await deleteType(btn.dataset.id, btn.dataset.type));
});
