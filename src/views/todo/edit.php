<form method="post">
    <input type="hidden" name="id" value="<?= $item['id'] ?>" />

    <div class="form-group">
        <label for="inpTodoTitle">title:</label>
        <input type="text" name="title" class="form-control" id="inpTodoTitle" value="<?= $item['title'] ?>" />
    </div>

    <div class="form-group">
        <label for="inpTodoText">text:</label>
        <input type="text" name="text" class="form-control" id="inpTodoText" value="<?= $item['text'] ?>" />
    </div>

    <button type="submit" class="btn btn-primary">Edit</button>
</form>
