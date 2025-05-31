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

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Title</th>
      <th scope="col">Text</th>
      <th scope="col">Author</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($articles as $article):?> 
    <tr>
      <th scope="row">1</th>
      <td><?=$article->getCreatedAt();?></td>
      <td><a href="<?=dirname($_SERVER['REQUEST_URI'])?>/article/<?=$article->getId();?>"><?=$article->getTitle();?></a></td>
      <td><?=$article->getText();?></td>
      <td><?=$article->getAuthorId()->getNickname();?></td>
      <td>
        <a href="<?=dirname($_SERVER['REQUEST_URI'])?>/article/<?=$article->getId();?>/edit" class="btn btn-primary btn-sm">Редактировать</a>
        <form action="<?=dirname($_SERVER['REQUEST_URI'])?>/article/<?=$article->getId();?>/delete" method="post" style="display: inline;">
          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить эту статью?');">Удалить</button>
        </form>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
