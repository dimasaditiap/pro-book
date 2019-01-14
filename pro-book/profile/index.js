var edit_profile = document.getElementsByClassName("edit-profile")[0];
var name_edit_profile = document.getElementById("edit-profile__name");
var address_edit_profile = document.getElementById("edit-profile__address");
var phone_edit_profile = document.getElementById("edit-profile__phone");
var profile_tab = document.getElementById("profile_tab");
var card_number = document.getElementById('profile__card');

profile_tab.className = "header_app_content orange-background hover_lightOrange"

var isUserCardNumberValid = true;

function validateRegisterForm(username) {
    var alerts = "";

    alerts += validateName(name_edit_profile.value);
    alerts += validateAddress(address_edit_profile.value);
    alerts += validatePhone(phone_edit_profile.value);

    if (!isUserCardNumberValid) {
        alerts += '*Card number is not valid'
    }

    if (alerts.length == 0) {
        editUserCardNumber(username)
        return true;
    }
    alert(alerts);
    return false;
}

function validateCardNumberAjax(username) {
    fetch(`http://localhost:3000/customers/check`, {
        method: 'put',
        headers: new Headers({'content-type': 'application/json'}),
        body: JSON.stringify({
            username: username,
            card_number: card_number.value
        })
    })
        .then(res => res.json())
        .then(res => { 
            console.log(res)
            if (res == 1) {
                isUserCardNumberValid = true
            } else {
                isUserCardNumberValid = false
            }
        })
        .catch(err => console.log(err))
}

function getUserCardNumber(username) {
    fetch(`http://localhost:3000/customers/${username}`)
        .then(res => res.json())
        .then(res => {
            console.log(res)
            document.getElementById('profile__card').innerHTML = res.card_number
        })
        .catch(err => console.log(err))
}

function editUserCardNumber(username) {
    fetch(`http://localhost:3000/customers`, {
        method: 'put',
        headers: new Headers({'content-type': 'application/json'}),
        body: JSON.stringify({
            username: username,
            card_number: card_number.value
        })
    })
        .then(res => console.log(res))
        .catch(err => console.log(err))
}