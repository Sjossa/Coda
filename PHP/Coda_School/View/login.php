<div id="errors"></div>
<form method="post" id="login-form">
    <h1 class="text-center">Connexion</h1>
    <div class="mb-3">
        <label for="username" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="username">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="button" class="btn btn-primary" name="login_button" id="valid-login-btn">Submit</button>
</form>
<script src="./asset/js/services/login.js" type="module"></script>
<script type="module">
    import {login} from "./asset/js/services/login.js";

    document.addEventListener('DOMContentLoaded',  () => {
        const validLoginBtn = document.querySelector('#valid-login-btn')
        const loginForm = document.querySelector('#login-form')
        const errors = document.querySelector('#errors')
        validLoginBtn.addEventListener('click', async () => {
            if(loginForm.checkValidity() == false) {
                loginForm.reportValidity()
                return false
            }
            let loginResult = await login(loginForm.elements['username'].value, loginForm.elements['password'].value)
            if(loginResult.hasOwnProperty('authentication')) {
                document.location.href="index.php"
            } else if (loginResult.hasOwnProperty('errors')) {
                for(let i = 0; i < loginResult.errors.length; i++) {
                    const errorDiv = document.createElement('div')
                    errorDiv.classList.add('alert', 'alert-danger')
                    errorDiv.setAttribute('role', 'alert')
                    errorDiv.innerHTML = `${loginResult.errors[i]}`
                    errors.appendChild(errorDiv)
                }
            }
        })
    })
</script>
