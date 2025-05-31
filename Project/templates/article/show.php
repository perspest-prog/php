<?php require(dirname(__DIR__).'/header.php');?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success']; ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<div class="card mt-3">
  <div class="card-body">
    <h5 class="card-title"><?=$article->getTitle();?></h5>
    <h6 class="card-subtitle mb-2 text-muted">Автор: <?=$article->getAuthorId()->getNickname();?></h6>
    <p class="card-text"><?=$article->getText();?></p>
    <div class="btn-group" role="group">
        <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$article->getId();?>/edit" class="btn btn-primary">Редактировать</a>
        <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$article->getId();?>/delete" class="btn btn-danger">Удалить</a>
    </div>
  </div>
</div>

<!-- Форма комментария -->
<div class="card mt-4">
    <div class="card-body">
        <h5>Добавить комментарий</h5>
        <form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/store" method="post">
            <input type="hidden" name="article_id" value="<?=$article->getId();?>">
            <textarea class="form-control mb-2" name="text" rows="3"></textarea>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>

<!-- Комментарии -->
<?php if (!empty($comments)): ?>
    <div class="card mt-4">
        <div class="card-body">
            <h5>Комментарии</h5>
            <?php foreach($comments as $comment): ?>
                <div class="border-bottom mb-3 pb-3">
                    <p><?=$comment->getText();?></p>
                    <div>
                        <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/edit" class="btn btn-sm btn-primary">Редактировать</a>
                        <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/delete" class="btn btn-sm btn-danger">Удалить</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php require(dirname(__DIR__).'/footer.html');?>
