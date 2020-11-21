<div class="container">
    <a href="#"><- Revenir en arrière</a>
    <form style="margin: 20px 0;">
        <div class="form-group">
            <input type="text" class="form-control" id="title" placeholder="Titre">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="comment" rows="3" placeholder="Commentaire"></textarea>
        </div>
        <div class="form-group" style="display: flex">
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
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option value="8">8h</option>
                <option value="9">9h</option>
                <option value="10">10h</option>
            </select>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option value="0">00</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn active" style="background-color:#F7B538">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option2" autocomplete="off"> Radio
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option3" autocomplete="off"> Radio
            </label>
        </div>
    </form>
</div>