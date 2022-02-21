<?php

require 'includes/database.php';

$conn = getDB();

echo "ur mom is here" . " ";

$sql = "SELECT *
        FROM article
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if ($results === false) {
  echo mysqli_error($conn);
} else {
  $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
  // var_dump($articles);
}
?>
<?php require 'includes/header.php'; ?>
    <?php if (empty($articles)): ?>
      <p>ur mom wasn't found :/</p>
    <?php else: ?>

      <ul>
        <?php foreach ($articles as $article): ?>
          <li>
            <article>
              <h2><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h2>
              <p><?= htmlspecialchars($article['content']); ?></p>
            </article>
          </li>
        <?php endforeach; ?>
      </ul>

    <?php endif; ?>
<?php require 'includes/footer.php'; ?>
