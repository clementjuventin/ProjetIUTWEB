<body class="bodyL" style="background-color:<?php echo ViewModel::getColor(); ?>;">
    <div class="box">
        <form method="post">
            <h1>Todo List</h1>
            <input type="text" name="login" placeholder="Nom d'utilisateur">
            <input type="password" name="password" placeholder="Mot de passe" required>
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
            <input type="submit" name="connexion" value="Connexion" required>
            <input type="hidden" name="action" value="signIn">
        </form>
        <form>
            <input type="submit" name="inscription" value="Profil publique">
            <input type="hidden" name="action" value="public">
        </form>
        <form>
            <input type="submit" name="inscription" value="Inscription">
            <input type="hidden" name="action" value="signUpRedirect">
        </form>
    </div>
</body>
