function validateLoginForm() {
    const usernameValue = document.querySelector('input[name="username"]').value
    const passwordValue = document.querySelector('input[name="password"]').value

    return usernameValue.trim() !== '' && passwordValue.trim() !== ''
}