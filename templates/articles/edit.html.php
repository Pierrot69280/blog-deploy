<form action="?type=article&action=edit" method="post" class="form-control border border-primary">

    <input placeholder="titre" type="text" name="title" class="form-control mb-2" value="<?= $article->getTitle() ?>">
    <textarea class="form-control" name="content"  cols="30" rows="3" placeholder="contenu"><?= $article->getContent() ?></textarea>
    <input type="hidden" name="idArticle"  value="<?= $article->getId() ?>">

    <button class="btn btn-warning mt-3" type="submit" >Modifier</button>

</form>