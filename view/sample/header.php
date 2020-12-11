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
                <form style="display: inline-block;" class="form-inline">
                    <select class="custom-select my-1 mr-sm-2" id="day" onchange="dayChange()">
                        <?php
                        $day = (int)date("d");
                        for ($i = 1; $i <= 31; $i++) {
                            if($day==$i){
                                echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                                continue;
                            }
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                    <select class="custom-select my-1 mr-sm-2" id="month" onchange="monthChange()">
                        <?php
                        $m = (int)date("m")-1;
                        $month = array("Janvier","F&eacute;vrier","Mars","Avril","Mai","Juin","Juillet","Ao&ucirc;t","Septembre","Octobre","Novembre","D&eacute;cembre");
                        for ($i = 0; $i < 12; $i++) {
                            if($i==$m){
                                echo '<option value="'.$month[$i].'" selected="selected">'.$month[$i].'</option>';
                                continue;
                            }
                            echo '<option value="'.$month[$i].'">'.$month[$i].'</option>';
                        }
                        ?>
                    </select>
                    <select class="custom-select my-1 mr-sm-2" id="year" onchange="yearChange()">
                        <?php
                        $year = (int)date("Y");
                        for ($i = $year; $i <= $year+10; $i++) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </form>
                <form style="display: inline-block;">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter une t&acirc;che</button>
                    <input type="hidden" name="action" value="addTask">
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
