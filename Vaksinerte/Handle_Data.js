let registrations = [];

let vaksineid_start_increment = 1;

Update_Data();

// Registrering av data
function Register_Data () {
    let vaksineId = latest_vaksineid;
    let brukerId = document.getElementById("brukerId").value;
    let ansattId = document.getElementById("ansattId").value;
    let dato = document.getElementById("dato").value;
    let tid = document.getElementById("tid").value;
    let lokasjon = document.getElementById("lokasjon").value;

    if (!vaksineId || !brukerId || !ansattId || !dato || !tid || !lokasjon) {
        errorElement.innerText = "Alle felt må fylles ut.";
        return;
    }

    let formData = new FormData();
    formData.append('vaksineId', vaksineId);
    formData.append('brukerId', brukerId);
    formData.append('ansattId', ansattId);
    formData.append('dato', dato);
    formData.append('tid', tid);
    formData.append('lokasjon', lokasjon);

    fetch('PHP/Register_Data.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        console.log(result); // Debugging
        Update_Data();
        document.getElementById("register").reset();
    })
    .catch(error => console.error('Error:', error));

}

// Sletting av data
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

        cell1.innerHTML = registration.vaksineId;
        cell2.innerHTML = registration.brukerId;
        cell3.innerHTML = registration.ansattId;
        cell4.innerHTML = registration.dato;
        cell5.innerHTML = registration.tid;
        cell6.innerHTML = registration.lokasjon;
        

        let removeButton = document.createElement("button");
        removeButton.innerHTML = "Fjern";
        removeButton.onclick = function() {
            Unregister_Data(i);
        };
        cell7.appendChild(removeButton);
    });
}


// Oppdater tabellen til å være lik databasen
function Update_Data() {
    fetch('PHP/Retrieve_Data.php')
    .then(response => response.json())
    .then(data => {
        if (Array.isArray(data)) {
            registrations = data;
 
            if (registrations.length === 0) {
                latest_vaksineid = vaksineid_start_increment;
            } else {
                const maxId = Math.max(...registrations.map(item => parseInt(item.vaksineId)));
                latest_vaksineid = maxId + 1 || vaksineid_start_increment;
                console.log(registrations.length);
            }

            Update_Table();
        } else {
            console.error('Data retrieved is not in the expected format.');
        }
    })
    .catch(error => console.error('Error:', error));
}
