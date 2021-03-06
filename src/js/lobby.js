function addPlayerToTable(id, username) {
	const Row = document.createElement('tr');
	const Column1 = document.createElement('td');
	const Column2 = document.createElement('td');
	Column1.innerText = id;
	Column2.innerText = username;
	Row.appendChild(Column1);
	Row.appendChild(Column2);
	document.getElementById('lobby').appendChild(Row);
}


function checkLobbyStatus(string) {
	const startGameButton = document.getElementById('start');
	const gameCheckLabel = document.getElementById('info');
	if (string === "TRUE") {
		startGameButton.disabled = false;
		startGameButton.classList.remove('disabled');
		gameCheckLabel.innerText = 'Πατήστε Έναρξη για να ξεκινήσει το παιχνίδι';
	} else {
		startGameButton.disabled = true;
		startGameButton.classList.add('disabled');
		gameCheckLabel.innerText = 'Χρειάζονται τουλάχιστον 2 παίκτες για να ξεκινήσει το παιχνίδι';
	}
}

setInterval(async () => {
	document.getElementById('lobby').innerHTML = `<tr>
        <th>ID Πάικτη</th>
        <th>Username</th>
    </tr>`;
	const data = await fetch('/~it174916/ADISE21_MOUTZOURIS/src/api/moutzouris.php/lobby').then((res) => res.json());
	data.players.forEach((element) => {
		for (const [id, username] of Object.entries(element)) {
			addPlayerToTable(id, username);
		}
	});
	
	checkLobbyStatus(data.status);
}, 2000);