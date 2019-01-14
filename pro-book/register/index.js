var isUsernameValid = true
var isEmailValid = true;
var isCardNumberValid = true;

function validateRegisterForm() {
    var alerts = "";
    var form = document.forms["myform"];

    alerts += validateName(form["name"].value);
    if (isUsernameValid) {
        alerts += validateUsername(form["username"].value);
    }
    else {
        alerts += "*Username is not valid\n";
    }

    if (isEmailValid) {
        alerts += validateEmail(form["email"].value);
    }
    else {
        alerts += "*Email is not valid\n";
    }

    if (!isCardNumberValid) {
        alerts += "*Card number is not valid\n";
    }

    alerts += validatePassword(form["password"].value, form["password2"].value);
    alerts += validateAddress(form["address"].value);
    alerts += validatePhone(form["phone"].value);

    if (alerts.length == 0) {
        addCustomer()
        return true
    }
    alert(alerts);
    return false;
}

function addCustomer() {
    var form = document.forms["myform"];

    fetch('http://localhost:3000/customers', {
        method: 'post',
        body: JSON.stringify({
            username: form["username"].value,
            card_number: form["card_number"].value
        }),
        headers: new Headers({'content-type': 'application/json'})
    })
        .then(res => console.log(res))
        .catch(err => console.log(err))
}

function validateUsernameAjax() {
    var username = document.getElementById("username");
    var status = document.getElementById("status");
    if (username.value.length != 0) {
        fetch('/server/api/post_username.php', {
            method: 'post',
            body: JSON.stringify({
                username: username.value
            })
        })
            .then(res => res.json())
            .then(statusNumber => {
                if (statusNumber == 1) {
                    status.innerHTML = "<img src=\"../assets/img/checklist-orange.png\"/>";
                    isUsernameValid = true;
                }
                else {
                    status.innerHTML = "<img src=\"../assets/img/close.png\"/>";
                    isUsernameValid = false;
                }
            })
            .catch(err => console.error(err))
    }
    else {
        status.innerHTML = "<img src=\"../assets/img/close.png\"/>";
        isUsernameValid = false;
    }
}

function validateEmailAjax() {
    let email = document.getElementById("email");
    let status = document.getElementById("status2");

    if (email.value.length != 0) {
        fetch('/server/api/post_email.php', {
            method: 'post',
            body: JSON.stringify({
                email : email.value
            })
        })
            .then(res => res.json())
            .then(statusNumber => {
                if (statusNumber == 1) {
                    status.innerHTML = "<img src=\"../assets/img/checklist-orange.png\"/>";
                    isEmailValid = true;
                }
                else {
                    status.innerHTML = "<img src=\"../assets/img/close.png\"/>";
                    isEmailValid = false;
                }
            })
            .catch(err => console.error(err))
    }
    else {
        status.innerHTML = "<img src=\"../assets/img/close.png\"/>";
        isEmailValid = false;
    }
}

function validateCardNumberAjax() {
    let cardNumber = document.getElementById("card_number");
    let status = document.getElementById("status_card_number");

    if (cardNumber.value.length > 0) {
        fetch(`http://localhost:3000/customers/${cardNumber.value}`, {
            method: 'post',
        })
            .then(res => res.json())
            .then(statusNumber => {
                if (statusNumber == 0) {                
                    status.innerHTML = "<img src=\"../assets/img/close.png\"/>";
                    isCardNumberValid = false;
                } else {
                    status.innerHTML = "<img src=\"../assets/img/checklist-orange.png\"/>";
                    isCardNumberValid = true;
                }
            })
            .catch(err => console.error(err))
    }
}