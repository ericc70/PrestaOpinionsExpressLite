let myChart = null;

function insertNoDataMessage(containerSelector, message) {
    const container = document.querySelector(containerSelector);

    // Vérifier si le conteneur existe
    if (container) {
        // Créer une div pour afficher le message
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('alert', 'alert-warning'); 
        messageDiv.textContent = message; // Ajouter le message

        // Ajouter la div au début du conteneur
        container.insertBefore(messageDiv, container.firstChild);
    } else {
        console.error('Container not found:', containerSelector);
    }
}

function removeNoDataMessage(containerSelector) {
    const container = document.querySelector(containerSelector); 

    // Vérifier si le conteneur existe
    if (container) {
        // Supprimer tous les messages "Pas de données disponibles" du conteneur
        const messages = container.querySelectorAll('.alert.alert-warning');
        messages.forEach(message => {
            container.removeChild(message);
        });



    } else {
        console.error('Container not found:', containerSelector);
    }
}

function showSpinner() {
    const spinners = document.querySelectorAll('.spinner'); 
    spinners.forEach(spinner => { 
        spinner.style.display = 'block'; 
    });

    document.querySelector('.table-body').style.display = 'none';
    document.querySelector('#chart-epl').style.display = 'none'; 
    document.querySelector('#date-viewer').style.display = 'none';
}


function hideSpinner() {
    const spinners = document.querySelectorAll('.spinner'); 
    spinners.forEach(spinner => { 
        spinner.style.display = 'none'; 
    });

    document.querySelector('.table-body').style.display = 'table-row-group';
    document.querySelector('#chart-epl').style.display = 'block'; 
    document.querySelector('#date-viewer').style.display = 'block'; 
}


function getBaseUrl() {
    let pathSegments = window.location.pathname.split('/');
    let prefix = pathSegments[1];
    return window.location.origin + '/' + prefix + '/express-opinion-lite';
}


document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#calendar_form');
    const submitButtons = form.querySelectorAll('button[type="submit"]');
    const datepickerFrom = document.querySelector('#datepickerFrom');
    const datepickerTo = document.querySelector('#datepickerTo');

    const today = new Date();
    const sixMonthsAgo = new Date();
    sixMonthsAgo.setMonth(today.getMonth() - 6);

    const pickto = (date) => date.toISOString().split('T')[0];

    datepickerFrom.value = pickto(sixMonthsAgo);
    datepickerTo.value = pickto(today);

    submitButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            handleFormSubmit(event, this);
        });
    });



    datepickerFrom.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault()
            triggerSubmitDatePicker();
        }
    });

    datepickerTo.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault()
            triggerSubmitDatePicker();
        }
    });


    function handleFormSubmit(event, button) {
        event.preventDefault();

        const buttonName = button.getAttribute('name');
        const formData = new FormData();
        const url = form.getAttribute('action');
        const method = form.getAttribute('method');

        formData.append('buttonName', buttonName);

        if (buttonName === "submitDatePicker") {
            const dateFrom = document.querySelector('#datepickerFrom').value;
            const dateTo = document.querySelector('#datepickerTo').value;
            formData.append('dateFrom', dateFrom);
            formData.append('dateTo', dateTo);
        }
        fetchNewData(formData)
            .then(data => {
                resetData();
                displayNewData(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function triggerSubmitDatePicker() {
        const submitDatePickerButton = form.querySelector('#submitDatePicker');
        submitDatePickerButton.click();
    }
});



function resetData() {
    const tbody = document.querySelector('tbody')
    tbody.innerHTML = ''
}


function fetchNewData(formData) {
    showSpinner()
    removeNoDataMessage('#table-01');
    removeNoDataMessage('#chart-01');
    const params = new URLSearchParams(window.location.search)
    const tokenValue = params.get('_token')

    return fetch(`${getBaseUrl()}/vote/a?_token=${tokenValue}`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            hideSpinner()
            return data

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}


function displayNewData(data) {
    try {
        if (myChart !== null) {
            myChart.destroy();
        }

        const ctx = document.getElementById('chart-epl').getContext('2d');
        myChart = new Chart(ctx, chartConfig(data));

        // Écrire le tableau
        const tbody = document.querySelector('tbody');

        const items = JSON.parse(data[0]);
        // Vérifier si 'items' est un tableau avant d'utiliser 'forEach'
        if (Array.isArray(items.data)) {
            if (items.data.length === 0) {
                insertNoDataMessage('#table-01', 'Pas de données disponibles');
            }
            items.data.forEach(item => {
                const row = document.createElement('tr');
                const reponseCell = document.createElement('td');
                reponseCell.textContent = item.responseContent;
                const nombreCell = document.createElement('td');
                nombreCell.textContent = item.voteCount;
                row.appendChild(reponseCell);
                row.appendChild(nombreCell);
                tbody.appendChild(row);
            });

        } else {
            console.log('items.data is not an array');
        }

        getDateFetch(items.extra.date);
    } catch (error) {
        console.error('Error displaying data:', error);
        insertNoDataMessage('#chart-01', 'Server error');
        insertNoDataMessage('#table-01', 'Server error');
    }
}



function loadData() {
    resetData()
    const formData = new FormData()
    formData.append('buttonName', 'submitDateDay');
    fetchNewData(formData)
        .then(data => {
            displayNewData(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

}

function getDateFetch(data) {
)
    let textDate;
    const contentDate = document.querySelector('#date-viewer')

    // Si data est une chaîne de caractères
    if (typeof data === 'string') {
        textDate = formatDate(data)
        contentDate.innerText = textDate
    }
    // Si data est un tableau
    else if (Array.isArray(data)) {
        let dateArray = []
        for (let i = 0; i < data.length; i++) {
            dateArray.push(formatDate(data[i]))
        }
        contentDate.innerText = dateArray.join(' - ')
    }
}

function formatDate(dateStr) {
    let parts = dateStr.split('-');
    let date;

    if (parts.length === 1) {
        // Only year is provided
        date = new Date(parts[0], 0, 1);
        return `Année ${date.getFullYear()}`;
    } else if (parts.length === 2) {
        // Year and month are provided
        date = new Date(parts[0], parts[1] - 1, 1); // 
        return `${date.toLocaleString('fr-FR', { month: 'long' })} ${date.getFullYear()}`;
    } else if (parts.length === 3) {
        // Full date is provided
        date = new Date(parts[0], parts[1] - 1, parts[2]); // 
        return `${date.getDate()} ${date.toLocaleString('fr-FR', { month: 'long' })} ${date.getFullYear()}`;
    }
}


window.addEventListener('load', (event) => {
    let myChart = null;
    loadData();
});

// chart js

function chartConfig(data) {
    // Configuration du graphique

    const dataArray = JSON.parse(data[0]);
    const dataArrayData = dataArray.data
    const chartContainer = document.querySelector('#chart-epl')
    if (dataArrayData.length === 0) {
        insertNoDataMessage('#chart-01', 'Pas de données disponibles');

        chartContainer.style.display = 'none';

    } else {
        if (chartContainer) {
            chartContainer.style.display = 'block';
        }
        const chartData = {
            labels: dataArrayData.map(item => item.responseContent),
            datasets: [{
                label: 'Votes',
                data: dataArrayData.map(item => item.voteCount),
                backgroundColor: [
                    'rgba(74, 105, 189, 0.2)',  // Bleu Lavande
                    'rgba(88, 214, 141, 0.2)',  // Vert Menthe
                    'rgba(245, 203, 92, 0.2)',  // Jaune Soleil
                    'rgba(231, 76, 60, 0.2)',   // Rouge Tomate
                    'rgba(155, 89, 182, 0.2)',  // Violet Améthyste
                    'rgba(241, 196, 15, 0.2)'   // Jaune Moutarde
                ],
                borderColor: [
                    'rgba(74, 105, 189, 1)',    // Bleu Lavande
                    'rgba(88, 214, 141, 1)',    // Vert Menthe
                    'rgba(245, 203, 92, 1)',    // Jaune Soleil
                    'rgba(231, 76, 60, 1)',     // Rouge Tomate
                    'rgba(155, 89, 182, 1)',    // Violet Améthyste
                    'rgba(241, 196, 15, 1)'     // Jaune Moutarde
                ],
                borderWidth: 1
            }]
        };

        const chartConfig = {
            type: 'doughnut',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false,

                    }
                }
            }
        };

        return chartConfig;
    }
}