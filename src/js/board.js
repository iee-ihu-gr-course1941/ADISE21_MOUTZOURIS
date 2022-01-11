funciton addCardtoHand (){
	const Row = document.createElement('tr');
	const Column1 = document.createElement('td');
	const Column2 = document.createElement('td');
	Column1.innerText = symbol;
	Column2.innerText = number;
	Row.appendChild(Column1);
	Row.appendChild(Column2);
	document.getElementById('board').appendChild(Row);
}




setInterval(async () => {
	document.getElementById('cards').innerHTML = `<tr>
    </tr>`;
	const data = await fetch(`${url}/api/moutzouris.php/board/getGameCards`).then((res) => res.json());
	data.board.forEach((element)) => {
		for (const [symbol, number] of Object.entries(element)) {
			addCardtoHand(symbol, number);
		}
	});
	
	checkLobbyStatus(data.status);
}, 2000);