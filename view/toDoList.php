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
<body>
    <div class="container" style="text-align: center;line-height: 3;">
        <div id="accordion">
            <?php
            foreach ($list as $lis){
                echo '<div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        '.$lis->getLabel().'
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-key"></i></th>
                                    <th scope="col"><i class="fas fa-thumbtack"></i> T&acirc;che</th>
                                    <th scope="col"><i class="fas fa-comment-dots"></i> Commentaire</th>
                                    <th scope="col"><i class="fas fa-clock"></i> Heure</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                      ';
                foreach ($lis->getTask() as $t){
                    $settings = '
                        <button type="button" class="btn btn-danger" style="width: 2.5em"><i class="fas fa-times"></i></button>
                        <button type="button" class="btn btn-success" style="width: 2.5em"><i class="fas fa-check"></i></button>
                        ';
                    echo '<tr style="background-color: '.$t->getColor().';">
                                <td>'.$t->getTitre().'</td>
                                <td>'.$t->getDescription().'</td>
                                <td class="hiddenButton">'.$settings.'</td>
                            </tr>
                    ';
                }
                      echo '</tbody></table></div></div></div>';
            }
            ?>
    </div>
</body>