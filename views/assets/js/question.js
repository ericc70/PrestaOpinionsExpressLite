function getBaseUrl() {
    let pathSegments = window.location.pathname.split('/');
    let prefix = pathSegments[1];
    return window.location.origin + '/' + prefix + '/express-opinion-lite';
}

var params = new URLSearchParams(window.location.search);

// Récupérer la valeur du paramètre _token
var tokenValue = params.get('_token');


document.addEventListener("DOMContentLoaded", () => {
    const nameCells = document.querySelectorAll('#myTable tr td:nth-child(2)');

    nameCells.forEach(cell => {
        const rowId = cell.parentElement.querySelector('th').innerText; // ID de la ligne associée

        let originalContents = {}; // Objet pour stocker les contenus d'origine des cellules par ID de ligne

        cell.addEventListener('focus', () => {
            // Stocker le contenu d'origine de la cellule lorsqu'elle gagne le focus
            originalContents[rowId] = cell.innerText.trim();
            cell.style.whiteSpace = 'nowrap';
        });
        cell.addEventListener('keydown', event => {
            if (event.key === 'Enter') {
                event.preventDefault(); // Empêcher le saut de ligne lorsque la touche "Enter" est pressée
                cell.blur(); // Enlever le focus de la cellule
            }
        });
        cell.addEventListener('blur', () => {
            const id = cell.parentElement.querySelector('th').innerText;
            const name = cell.innerText;
            const row = cell.parentElement;

            // Stocker le contenu d'origine de la cellule

            console.log(originalContents)

            const spinner = document.createElement('div');
            spinner.className = 'spinner'; // Ajoutez votre classe CSS pour le spinner
            cell.appendChild(spinner);

            fetch(`${getBaseUrl()}/response/a/edit?_token=${tokenValue}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        content: name,
                        questionId: 1
                    }) //questionId
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data.message);
                    displayNotify(cell, "Succes", "statusok");
                    spinner.remove();
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    cell.innerText = originalContents[rowId];
                    spinner.remove();
                    displayNotify(cell, "Error", "stauserror");
                })

            console.log(`ID: ${id}, Name: ${name}`);
        });


    });
});


const displayNotify = (cell, notifier, className) => {
    const message = document.createElement('span');
    message.className = className;
    message.textContent = notifier;
    cell.appendChild(message); // Ajouter le message à la cellule

    setTimeout(() => {
        message.remove(); // Supprimer le message après un certain délai
    }, 5000);
}