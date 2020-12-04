<body class="inscription bodyL">
    <div class="box">
        <form method="post">
            <h1>Inscription</h1>
            <input type="text" name="login" placeholder="Nom d'utilisateur" required>
            <span style="color: #b32323;">
            <?php
            if(isset($this->dataVueErreur)){
                if(isset($this->dataVueErreur['Login'])){
                    echo $this->dataVueErreur['Login'];
                    $this->dataVueErreur['Login'] = NULL;
                }
            }
            ?>
        </span>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="cpassword" placeholder="Confirmer Mot de passe" required>
            <span style="color: #b32323;">
            <?php
            if(isset($this->dataVueErreur)){
                if(isset($this->dataVueErreur['Password'])){
                    echo $this->dataVueErreur['Password'];
                    $this->dataVueErreur['Password'] = NULL;
                }
            }
            ?>
        </span>
            <input type="submit" value="Inscription" id="inscription">
            <input type="hidden" name="action" value="signUp">
        </form>
        <form  method="post">
            <input type="submit" name="connexion" value="Retour" id="login" required>
            <input type="hidden" name="action" value="NULL">
        </form>
    </div>
</body>
