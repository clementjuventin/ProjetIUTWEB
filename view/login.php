<style>
    body{
        height:100vh;
        font-family: sans-serif;
        background-image: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .box{
        min-width: 400px;
        padding: 30px;
        margin-left: auto;
        margin-right: auto;
        top: 50%;
        bottom: 50%;
        background: #191919;
        text-align: center;
        border-radius: 25px;
    }

    h1{
        color: white;
        text-transform: uppercase;
        font-weight: 400;

    }
    .box h5{
        border: 0px;
        background: none;
        display: block;
        margin:  auto;
        text-align: center;
        border: 2px solid #d63031;
        padding: 14px 10px;
        width: 150px;
        outline: none;
        color: white;
        border-radius: 24px;
        transition: 0.25s;

    }
    .box input[type = "text"], .box input[type= "password"]{
        border: 0px;
        background: none;
        display: block;
        margin: 20px auto;
        text-align: center;
        border: 2px solid #45aaf2;
        padding: 14px 10px;
        width: 200px;
        outline: none;
        color: white;
        border-radius: 24px;
        transition: 0.25s;
    }

    .box input[type = "text"]:focus,.box input[type = "password"]:focus{
        width: 250px;
        border-color: #20bf6b;
    }

    .box a{
        border: 0px;
        background: none;
        display: block;
        margin: 20px auto;
        text-align: center;
        border: 2px solid #8e44ad;
        padding: 9px 6px;
        width: 125px;
        color: white;
        font-style: oblique 60deg;
        border-radius: 24px;
        transition: 0.25s;
        text-decoration: none;
    }


    .box input[type = "submit"]{
        border: 0px;
        background: none;
        display: block;
        margin: 20px auto;
        text-align: center;
        border: 2px solid #45aaf2;
        padding: 12px 8px;
        width: 200px;
        outline: none;
        color: white;
        border-radius: 24px;
        transition: 0.25s;
        font-size: 20px;

    }

    .box input[type = "submit"]:focus{
        border-color: #20bf6b;
    }
</style>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>


</head>
<body>
<div class="box">
    <form   method="post">
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


</html>