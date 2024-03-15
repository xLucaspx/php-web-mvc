const deleteProduct = async (id, name) => {
	// const url = `http://localhost:8080/remover-produto?id=${id}`;
	const url = `/remover-produto?id=${id}`;

	const deleteOk = confirm(`Tem certeza que deseja excluir o produto "${name}"?`);

	if (!deleteOk) return;

	try {
		const res = await fetch(url, {
			method: 'DELETE', headers: {"Content-Type": "application/json"}
		});

		if (!res.ok) {
			await res.json();
			alert(`Não foi possível excluir o produto "${name}":\n${res.error}`);
			return;
		}

		location.reload();
	} catch (error) {
		alert(error.message);
	}
}

const deleteButtons = document.querySelectorAll('.delete-product-button');
deleteButtons.forEach((btn) => {
	(btn.onclick = async (evt) => await deleteProduct(btn.dataset.id, btn.dataset.name));
});
