<style>
    .colors{
        width: 2rem;
        height: 2rem;
        transition: width 0.5s;
    }
    .colors:hover{
        width: 4rem;
    }
</style>
<body>
    <div class="container">
        <form style="display: inline-block;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-angle-double-left"></i> Annuler</button>
            <input type="hidden" name="action" value="displayTask">
        </form>
        <form style="margin: 20px 0;" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="title" name="title" placeholder="Titre" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="comment" rows="3" name="comment" placeholder="Commentaire"></textarea>
            </div>
            <div class="form-group" style="display: flex;">
                <select name="day" class="custom-select my-1 mr-sm-2" id="jour" onchange="addTaskDayChange()">
                    <?php
                    $day = (int)date("d");
                    var_dump($day);
                    for ($i = 1; $i <= 31; $i++) {
                        if($day==$i){
                            echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                            continue;
                        }
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    ?>
                </select>
                <select name="month" id="month" class="custom-select my-1 mr-sm-2" id="mois" onchange="addTaskMonthChange()">
                    <?php
                    $m = (int)date("m")-1;
                    $month = array("Janvier","F&eacute;vrier","Mars","Avril","Mai","Juin","Juillet","Ao&ucirc;t","Septembre","Octobre","Novembre","D&eacute;cembre");
                    for ($i = 0; $i < 12; $i++) {
                        if($i==$m){
                            echo '<option value="'.($i+1).'" selected="selected">'.$month[$i].'</option>';
                            continue;
                        }
                        echo '<option value="'.($i+1).'">'.$month[$i].'</option>';
                    }
                    ?>
                </select>
                <select name="year" class="custom-select my-1 mr-sm-2" id="annee">
                    <?php
                    $year = (int)date("Y");
                    for ($i = $year; $i <= $year+10; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    ?>
                </select>
                <select name="hour" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                    <?php
                    $heure = (int)date("h")+8;
                    for ($i = 0; $i < 24; $i++) {
                        if($i==$heure){
                            echo '<option value="'.$i.'" selected="selected">'.$i.'h</option>';
                            continue;
                        }
                        echo '<option value="'.$i.'">'.$i.'h</option>';
                    }
                    ?>
                </select>
                <select name="min" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                    <?php
                    $min = (int)date("i");
                    for ($i = 0; $i < 6; $i++) {
                        if(($i*10)>$min){
                            $min = 61;
                            echo '<option value="'.($i*10).'" selected="selected">'.($i*10).'</option>';
                            continue;
                        }
                        echo '<option value="'.($i*10).'">'.($i*10).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="btn-group btn-group-toggle" style="width: 100%; text-align: center" data-toggle="buttons">
                <?php
                $colors = ViewModel::getColors();
                for ($i = 0; $i < count($colors); $i++) {
                    echo '
                       <label class="btn btn-secondary colors" style="background-color:'.$colors[$i].'; border-color: '.$colors[$i].';">
                            <input type="radio" name="color" value="'.$colors[$i].'" id="radio'.$i.'" autocomplete="off" '.($i==0?'checked':'').'>
                       </label>
                    ';
                }
                ?>
            </div>
            <div style="margin-top: 1em">
                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-check"></i> Ajouter la t&acirc;che</button>
                <input type="hidden" name="action" value="addTaskSubmit">
            </div>
        </form>
    </div>
</body>
