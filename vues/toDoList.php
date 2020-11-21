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
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option value="01">Janvier</option>
                <option value="02">Février</option>
                <option value="03">Mars</option>
            </select>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
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