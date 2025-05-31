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

<form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$article->getId();?>/update" method="post">
    <div class="mb-3">
    <label for="date" class="form-label">Public date</label>
    <input type="text" class="form-control" id="date" name="date" value="<?=$article->getCreatedAt();?>">
    </div>
    <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?=$article->getTitle();?>">
    </div>
    <div class="mb-3">
    <label for="text" class="form-label">Text</label>
    <textarea class="form-control" id="text" rows="3" name="text"><?=$article->getText();?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php require(dirname(__DIR__).'/footer.html');?>
