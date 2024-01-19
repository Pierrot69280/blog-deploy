<?php

use Core\Session\Session;

?>
<div class="border border-primary rounded mb-5 p-2 ">
    <h3><?= $article->getTitle() ?></h3>
    <p class="fs-5"><?= $article->getContent() ?></p>

    <?php if (Session::user()['id']): ?>
        <a href="?type=article&action=edit&id=<?= $article->getId() ?>" class="btn btn-warning">Modifier</a>
        <a href="?type=article&action=delete&id=<?= $article->getId() ?>" class="btn btn-danger">Supprimer</a>
    <?php endif; ?>


</div>


<div class="border border-dark">
    <?php foreach ($article->getComments() as $comment): ?>

            <a class="nav-link active" aria-current="page" href="#"><?php
                $repo = new \App\Repository\UserRepository();
                $user= $repo->find($comment->getUserId());
                echo $user->getUsername();
                ?> </a>

        <?php


        if (Session::user()['id'] == $comment->getUserId()):
            ?>
            <a href="?type=comment&action=delete&id=<?= $comment->getId() ?>" class="btn btn-danger">Supprimer</a>
            <a href="?type=comment&action=update&id=<?= $comment->getId() ?>" class="btn btn-warning">Editer</a>
        <?php endif; ?>

        <p><strong><?= $comment->getContent() ?></strong></p>
    <?php endforeach; ?>


</div>



<div>
    <form action="?type=comment&action=create" method="post" class="mt-5">





        <input type="hidden" name="articleId" value="<?= $article->getId() ?>">
        <div class="mt-4" >

            <?php if (Session::userConnected()): ?>
                <div>
                    <input class="form-control border border-primary" type="text" name="content" placeholder="Un commentaire ?">
                </div>
                <button type="submit" class="btn btn-primary">Commenter</button>
            <?php else: ?>
                <p>Vous devez être connecté pour ajouter un commentaire. <a href="?type=security&action=signin">Se connecter</a></p>
            <?php endif; ?>


            <a href="?type=article&action=index" class="btn btn-secondary">Retour</a>
        </div>

    </form>
</div>