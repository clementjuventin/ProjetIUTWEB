<style>
    .hiddenButton button{
        visibility: hidden;
    }
    .hiddenButton {

    }
    .table tbody tr:hover .hiddenButton button{
        visibility: visible;
    }
</style>
<div class="container" style="text-align: center;line-height: 3;">
    <div style="width: 100%;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><i class="fas fa-key"></i></th>
                    <th scope="col"><i class="fas fa-thumbtack"></i> Tache</th>
                    <th scope="col"><i class="fas fa-comment-dots"></i> Commentaire</th>
                    <th scope="col"><i class="fas fa-clock"></i> Heure</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($task as $tsk){
                        $settings = '
                           <button type="button" class="btn btn-danger" style="width: 2.5em"><i class="fas fa-times"></i></button>
                           <button type="button" class="btn btn-success" style="width: 2.5em"><i class="fas fa-check"></i></button>
                           <button type="button" class="btn btn-primary" style="width: 2.5em" value="'.$tsk->getId().'"><i class="fas fa-cog"></i></button>
                        ';
                                echo '<tr style="background-color: '.$tsk->getColor().';">
                            <th scope="row">'.($tsk->isPublic()?"<i class=\"fas fa-lock-open\"></i>":"<i class=\"fas fa-lock\"></i>").'</th>
                            <td>'.$tsk->getTitre().'</td>
                            <td>'.$tsk->getDescription().'</td>
                            <td>'.$tsk->getHour().'</td>
                            <td class="hiddenButton">'.$settings.'</td>
                        </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>