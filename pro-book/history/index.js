var browse_tab = document.getElementById("history_tab");
browse_tab.className = "header_app_content orange-background hover_lightOrange";

function validateReviewForm() {
    var alerts = "";
    var form = document.forms["myform2"];

    alerts += validateRating(form["star"].value);
    alerts += validateComment(form["comment"].value);

    if (alerts.length == 0) {
        return true;
    }

    alert(alerts);
    return false;
}