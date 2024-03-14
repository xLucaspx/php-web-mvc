const excluiProduto = async (id, nome) => {
	// const url = `http://localhost:8080/deleta-produto.php?id=${id}`;
	const url = `../../deleta-produto.php?id=${id}`;

	const continuar = confirm(`Tem certeza que deseja excluir o produto ${nome}?`);

	if (!continuar) return;

	try {
		const res = await fetch(url, {
			method: 'DELETE', headers: {"Content-Type": "application/json"}
		});

		if (!res.ok) {
			alert("Não foi possível excluir o produto!");
			return;
		}

		location.reload();
	} catch (error) {
		alert(error.message);
	}
}

const botoesExcluir = document.querySelectorAll('.botao-excluir');
botoesExcluir.forEach((btn) => {
	(btn.onclick = async (evt) => await excluiProduto(btn.dataset.id, btn.dataset.nome));
});
