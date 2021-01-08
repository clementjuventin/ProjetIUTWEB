<div style="height: 100px;">

</div>                                                                  <!--position:fixed;top: 0;-->
<style>
    .headerUl li{
        margin: 3px;
    }
</style>
<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark" style="position:fixed;top: 0;width: 100%;min-height: 80px; z-index: 100;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto headerUl">
            <li class="nav-item">
                <form style="display: inline-block;">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> D&eacute;connexion</button>
                    <input type="hidden" name="action" value="logOut">
                </form>
            </li>
            <li class="nav-item">
                <form style="display: inline-block;">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter une t&acirc;che</button>
                    <input type="hidden" name="action" value="addTask">
                </form>
            </li>
            <li class="nav-item">
                <form style="display: inline-block;">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter une liste</button>
                    <input type="hidden" name="action" value="addList">
                </form>
            </li>
        </ul>
    </div>
</nav>

