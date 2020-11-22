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
<div class="container" style="text-align: center;">
    <div style="width: 100%;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><i class="fas fa-key"></i></th>
                    <th scope="col"><i class="fas fa-thumbtack"></i> Tâche</th>
                    <th scope="col"><i class="fas fa-comment-dots"></i> Commentaire</th>
                    <th scope="col"><i class="fas fa-clock"></i> Heure</th>
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
</div>