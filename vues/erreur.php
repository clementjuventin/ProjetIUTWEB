<?php
    require (__DIR__.'/../vues/head.php');
?>
<div class="container" style="margin-top: 100px">
    <h1 style="text-align: center;">Page d'erreur</h1>
    <?php
    if (isset($dataVueErreur)) {
        foreach ($dataVueErreur as $value){
            echo '  <div class="alert alert-danger">
                        <strong>Error</strong> '.$value.'
                    </div>';
        }
    }
    ?>

</div>
<?php
    require (__DIR__.'/../vues/footer.php');
?>
