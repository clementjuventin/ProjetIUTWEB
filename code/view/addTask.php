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
            <span style="color: #b32323;">
            <?php
            if(isset($this->dataVueErreur)){
                if(isset($this->dataVueErreur['ListId'])){
                    echo "Veuillez choisir une liste valide pour assigner la nouvelle t&acirc;che.";
                    $this->dataVueErreur['ListId'] = NULL;
                }
            }
            ?>
            </span>
            <div class="form-group" style="display: flex;">
                <select name="listLabel" class="custom-select my-1 mr-sm-2" id="listLabel">
                    <?php
                    foreach ($list as $li){
                        echo '<option value="'.$li->getId().'">'.$li->getLabel().'</option>';
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
