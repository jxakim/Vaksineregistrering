let registrations = [];

Update_Data(); // Oppdater tabellen til å være lik databasen.

// Håndtering av registrering av data
function Register_Data () {
    // Få innholdet til feltene
    let navn = document.getElementById("navn").value;
    let etternavn = document.getElementById("etternavn").value;
    let telefon = document.getElementById("telefon").value;
    let mail = document.getElementById("mail").value;
    let adresse = document.getElementById("adresse").value;
    let postnr = document.getElementById("postnr").value;

    if (!navn || !etternavn || !telefon || !mail || !adresse || !postnr) {
        errorElement.innerText = "Alle felt må fylles ut.";
        return;
    }

    // Legg til denne dataen i tabellen
    let formData = new FormData();
    formData.append('navn', navn);
    formData.append('etternavn', etternavn);
    formData.append('telefon', telefon);
    formData.append('mail', mail);
    formData.append('adresse', adresse);
    formData.append('postnr', postnr);

    // Få tak i php fila som kobler opp med databasen (registrering)
    fetch('PHP/Register_Data.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        // Håndtering som skjer etter forespørselen
        Update_Data();
        document.getElementById("register").reset();
    })
    .catch(error => console.error('Error:', error));

}

function Unregister_Data(i) {
    let dataToRemove = registrations[i];

    fetch('PHP/Unregister_Data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataToRemove)
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
        Update_Data();
    })
    .catch(error => console.error('Error:', error));
}

// Oppdateringer av data

function Update_Table() {
    let table = document.getElementById("Datatabell");

    while (table.rows.length > 1) {
        table.deleteRow(1);
    }

    registrations.forEach((registration, i) => {
        let row = table.insertRow(-1);
        let cell1 = row.insertCell(0);
        let cell2 = row.insertCell(1);
        let cell3 = row.insertCell(2);
        let cell4 = row.insertCell(3);
        let cell5 = row.insertCell(4);
        let cell6 = row.insertCell(5);
        let cell7 = row.insertCell(6);
        let cell8 = row.insertCell(7);

        cell1.innerHTML = registration.navn;
        cell2.innerHTML = registration.etternavn;
        cell3.innerHTML = registration.telefon;
        cell4.innerHTML = registration.mail;
        cell5.innerHTML = registration.adresse;
        cell6.innerHTML = registration.postnr;
        cell7.innerHTML = registration.brukerId;   

        let removeButton = document.createElement("button");
        removeButton.innerHTML = "Fjern";
        removeButton.onclick = function() {
            Unregister_Data(i);
        };
        cell8.appendChild(removeButton);
    });
}

function Update_Data() {
    fetch('PHP/Retrieve_Data.php')
    .then(response => response.json())
    .then(data => {
        registrations = data;
        console.log(registrations);
        Update_Table();
    })
    .catch(error => console.error('Error:', error));
}