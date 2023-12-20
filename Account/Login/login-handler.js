function formSubmit() {
    const brukernavn = document.getElementById("brukernavn").value;
    const passord = document.getElementById("passord").value;

    let formData = new FormData();
    formData.append('brukernavn', brukernavn);
    formData.append('passord', passord);

    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        document.getElementById("output").innerHTML = result;
        if (result.trim() === "Velkommen inn.") {
            window.location.href = "../welcome.html";
        }
    })
    .catch(error => {
        document.getElementById("output").innerHTML = "An error occurred: " + error;
    });
};
