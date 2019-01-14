function validateName($input) {
    if ($input.length == 0) {
        return "*Name must be filled out\n";
    }

    if ($input.length > 20) {
        return "*Name must not contain more than 20 characters\n";
    }

    return "";
}

function validateUsername($input) {
    if ($input.length == 0) {
        return "*Username must be filled out\n";
    }

    return "";
}

function validateEmail($input) {
    if ($input.length == 0) {
        return "*Email must be filled out\n";
    }

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(String($input).toLowerCase())) {
        return "*Email is not valid\n";
    }

    return "";
}

function validatePassword($input, $input2) {
    if ($input.length == 0) {
        return "*Password must be filled out\n";
    }

    if ($input != $input2) {
        return "*Password does not match\n";
    }

    return "";
}

function validateAddress($input) {
    if ($input.length == 0) {
        return "*Address must be filled out\n";
    }

    return "";
}

function validatePhone($input) {
    if ($input.length == 0) {
        return "*Phone must be filled out\n";
    }

    if (($input.length < 9) || ($input.length > 12)) {
        return "*Phone must contain 9-15 digits\n";
    }

    return "";
}

function validateRating($input) {
    if ($input == 0) {
        return "*Rating must be filled out\n";
    }

    return "";
}

function validateComment($input) {
    if ($input.length == 0) {
        return "*Comment must be filled out\n";
    }

    return "";
}