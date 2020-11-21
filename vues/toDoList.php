<style>
    .hiddenButton button{
        visibility: hidden;
    }
    .hiddenButton {

    }
    .table tbody tr:hover .hiddenButton button{
        visibility: visible;
    }
    div{
        line-height: 3;
    }
</style>
<div class="container">
    <div style="text-align: center; padding: 10px; display: flex;">
        <h3 style="padding: 10px">Todo liste du </h3>
        <form class="form-inline">
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
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
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <?php
                $m = (int)date("m")-1;
                $month = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
                for ($i = 0; $i < 12; $i++) {
                    if($i==$m){
                        echo '<option value="'.$month[$i].'" selected="selected">'.$month[$i].'</option>';
                        continue;
                    }
                    echo '<option value="'.$month[$i].'">'.$month[$i].'</option>';
                }
                ?>
            </select>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <?php
                $year = (int)date("Y");
                for ($i = $year; $i <= $year+10; $i++) {
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }
                ?>
            </select>
        </form>
    </div>
    <div style="width: 100%;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tâche</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Heure</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($task as $tsk){
                        echo $tsk;
                    }
                ?>
            </tbody>
        </table>
    </div>
    <form>
        <button type="submit" class="btn btn-secondary btn-lg btn-block">Ajouter une tâche</button>
        <input type="hidden" name="action" value="addTask">
    </form>
</div>