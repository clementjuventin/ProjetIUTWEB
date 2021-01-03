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
            <div style="margin-top: 1em">
                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-check"></i> Ajouter la liste</button>
                <input type="hidden" name="action" value="addListSubmit">
            </div>
        </form>
    </div>
</body>
