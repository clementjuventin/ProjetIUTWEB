<body style="height: 100vh;">
    <div class="container" style="height: 100%;display: flex;align-items: center;justify-content: center;">
        <div class="loginForm" style="background-color: #eeeeee;padding: 20px; border-radius: 7px; margin: auto;">
            <form class="form-signin" method="post">
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>

                <input type="text" id="login" name="login" class="form-control" placeholder="Login" required="" autofocus="">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">

                <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
                <a href="#" id="forgot_pswd">Forgot password?</a>
                <hr>
                <!-- <p>Don't have an account!</p>  -->
                <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
                <input type="hidden" name="action" value="signIn">
            </form>
        </div>
    </div>
</body>
