<div class="container">
    <h1 style="text-align: center;">To do list du 21 Novembre 2020</h1>
    <div style="position:relative; width: 100%; max-height: 500px;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tâche</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Heure</th>
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
    <button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button>
    <button type="button" class="btn btn-danger" style="width: 2.5em"><i class="fas fa-times"></i></button>
    <button type="button" class="btn btn-success" style="width: 2.5em"><i class="fas fa-check"></i></button>
    <button type="button" class="btn btn-primary" style="width: 2.5em"><i class="fas fa-cog"></i></button>
</div>