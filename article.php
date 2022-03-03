<?php

require 'includes/database.php';
require 'includes/article.php';

$conn = getDB();

if (isset($_GET['id'])) {

  $article = getArticle($conn, $_GET['id']);

} else {
  $article = null;
}

?>
<?php require 'includes/header.php'; ?>

<a href="new-article.php">new article</a>

    <?php if ($article === null): ?>
      <p>ur mom wasn't found :/</p>
    <?php else: ?>

      <ul>
          <li>
            <article>
              <h2><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h2>
              <p><?= htmlspecialchars($article['content']); ?></p>
            </article>
          </li>
      </ul>

    <?php endif; ?>
<?php require 'includes/footer.php'; ?>
