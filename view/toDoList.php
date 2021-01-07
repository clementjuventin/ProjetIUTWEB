<style>
    .hiddenButton button{
        visibility: hidden;
    }
    .hiddenButton {

    }
    .table tbody tr:hover .hiddenButton button{
        visibility: visible;
    }
    .table tbody tr:hover .hiddenButton button{
        visibility: visible;
    
    }
    .strike {
  text-decoration: line-through;
}
</style>
<body>
    <div class="container" style="text-align: center;line-height: 3;">
        <div id="accordion">
            <?php
            $num = 0;
            foreach ($list as $lis){
                $logo = $lis->isPublic()?'<i class="fas fa-lock-open"></i>':'<i class="fas fa-key"></i>';
                echo '<div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        '.$logo.'<span style = "margin-left:1vh;"> '.$lis->getLabel().' </span>
                                        <form method="POST" style="display: inline-block;">
                                        <button type="submit"  name="action" value="delList" class="btn btn-danger" style="width: 2.5em"><i class="fas fa-times"></i></button>
                                        <input type="hidden" name="id" value="'.$lis->getId().'">
                                        </form>
                                    </button>
                                   

                                </h5>
                                
                            </div>
                            <div id="'.$num.'" class="collapse show" aria-labelledby="'.$num.'" data-parent="#accordion">
                                <div class="card-body">
                                <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-thumbtack"></i> T&acirc;che</th>
                                    <th scope="col"><i class="fas fa-comment-dots"></i> Commentaire</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                      ';
                $num = $num+1;
                foreach ($lis->getTaskArray() as $t){

                    $settings = '
                       

                        <form method="POST" style="display: inline-block;">
                        <button type="submit"  name="action" value="delTask" class="btn btn-danger" style="width: 2.5em"><i class="fas fa-times"></i></button>
                        <input type="hidden" name="id" value="'.$t->getId().'">
                        </form>
                    
                        <form method="POST" style="display: inline-block;">
                        <button id="yolo" type="submit"  name="action" value="doneTask" class="btn btn-success" style="width: 2.5em"><i class="fas fa-check"></i></button>
                        <input type="hidden" name="id" value="'.$t->getId().'">
                        </form>
                    ';
                 

                    echo '<tr class="'.$t->isDone().'" style="background-color: '.$t->getColor().';">
                        <div>
                                <td>'.$t->getTitre().'</td>
                                <td>'.$t->getDescription().'</td>
                        </div>        
                                <td class="hiddenButton">'.$settings.'</td>
                            </tr>
                    ';
                 
                }
                      echo '</tbody></table></div></div></div>';
            }
            ?>
    </div>
</body>


<script type="text/javascript">
                     $(document).ready(function () {
                        $(".1").css("background-color", "#A6A4A8");
                    });
 </script> 
