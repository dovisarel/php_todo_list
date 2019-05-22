<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">

    <title>Todo list</title>
</head>

<body>
    <div class="container-fluid app-container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Todo list</h1>
            </div>
        </div>

        <?php if(count($breadcrumb_items) > 0): ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php foreach($breadcrumb_items as $itemKey => $item): ?>
                        <?php if( array_key_last($breadcrumb_items) !== $itemKey ): ?>
                            <li class="breadcrumb-item"><a href="<?= $item['href'] ?>"><?= $item['text'] ?></a></li>
                        <?php else: ?>
                            <li class="breadcrumb-item active"><?= $item['text'] ?></li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ol>
            </nav>
        <?php endif ?>

        <div class="row">
            <div class="col">
                <?= $response ?>
            </div>
        </div>
    </div>
</body>

</html>