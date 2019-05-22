<div class="container">
    <div class="row todo-items-row todo-items-header-row">
        <h3 class="col-md-1 text-center">#</h3>
        <h3 class="col-md-9">text</h3>
        <h3 class="col-md-2 text-center">actions</h3>
    </div>
    <?php foreach($items as $item): ?>
        <div class="row todo-items-row">
            <div class="col-md-1 text-center"><?= $item['id'] ?></div>
            
            <div class="col-md-9">
                <h4><?= $item['title'] ?></h4>
                <p><?= $item['text'] ?></p>
                <div><?= $item['updated_at'] ?></div>
            </div>
            
            <div class="col-md-2 text-center">
                <a class="btn btn-sm btn-secondary" href="/index.php/todo/edit?id=<?= $item['id'] ?>">edit</a>
                <a class="btn btn-sm btn-danger" href="/index.php/todo/delete?id=<?= $item['id'] ?>">delete</a>
            </div>
        </div>
    <?php endforeach ?>

    <div class="row text-center todo-items-row todo-items-footer-row">
        <div class="col">
            <a class="btn btn-primary" href="/index.php/todo/create">create new</a>
        </div>
    </div>
</div>
