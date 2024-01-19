<h1>Les articles</h1>

<?php use Core\Session\Session;

foreach ($articles as $article): ?>
    <div class="border border-primary rounded mb-3 p-2">
        <h3><?= $article->getTitle() ?></h3>
        <p class="fs-5"><?= $article->getContent() ?></p>

        <?php if (Session::userConnected()): ?>
        <a href="?type=article&action=show&id=<?= $article->getId() ?>" class="btn btn-secondary">Voir</a>
        <?php endif; ?>

        <?php if (Session::userConnected()): ?>
            <a href="?type=article&action=edit&id=<?= $article->getId() ?>" class="btn btn-warning">Modifier</a>
            <a href="?type=article&action=delete&id=<?= $article->getId() ?>" class="btn btn-danger">Supprimer</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php if (Session::userConnected()): ?>
    <a href="?type=article&action=create" class="btn btn-success mt-5">Ajouter un article</a>
<?php else: ?>
    <p>Vous devez être connecté pour ajouter un nouvel article. <a href="?type=security&action=signin">Se connecter</a></p>
<?php endif; ?>
