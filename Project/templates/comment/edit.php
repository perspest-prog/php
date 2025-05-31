<?php require(dirname(__DIR__).'/header.php');?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Редактировать комментарий</h5>
        <form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/update" method="post">
            <div class="mb-3">
                <textarea class="form-control" name="text" rows="3"><?=$comment->getText();?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$comment->getArticleId();?>" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</div>

<?php require(dirname(__DIR__).'/footer.html');?> 