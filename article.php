<?php

require 'includes/database.php';

$conn = getDB();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

$sql = "SELECT *
        FROM article
        WHERE id = " . $_GET['id'];

var_dump($sql);

$results = mysqli_query($conn, $sql);

if ($results === false) {
  echo mysqli_error($conn);
} else {
  $article = mysqli_fetch_assoc($results);
  // var_dump($articles);
}
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
