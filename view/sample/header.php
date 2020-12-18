<div style="height: 100px;">

</div>                                                                  <!--position:fixed;top: 0;-->
<nav id="header" class="navbar navbar-expand-lg navbar-dark bg-dark" style="position:fixed;top: 0;width: 100%;min-height: 80px;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <form style="display: inline-block;">
            <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> D&eacute;connexion</button>
            <input type="hidden" name="action" value="logOut">
        </form>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Todolist<span class="sr-only">(current)</span></a>
            </li>
            <!--
            <li class="nav-item">
                <a class="nav-link" href="#">Journal</a>
            </li>
            -->
            <li class="nav-item">
                <form style="display: inline-block;">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter une t&acirc;che</button>
                    <input type="hidden" name="action" value="addTask">
                </form>
                <form style="display: inline-block;">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter une liste</button>
                    <input type="hidden" name="action" value="addList">
                </form>
            </li>
        </ul>
    </div>
</nav>
<script>
    function dayChange(){
        console.log(document.getElementById('day').value)
    }
    function monthChange(){
        console.log(document.getElementById('month').value)
    }
    function yearChange(){
        console.log(document.getElementById('year').value)
    }
</script>
