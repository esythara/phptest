<?php if (! empty($errors)): ?>
  <ul>
    <?php foreach ($errors as $error): ?>
      <li><?= $error ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post">

  <div>
    <label for="title">title</label>
    <input name="title" id="title" placeholder="yr mom" value="<?= htmlspecialchars($title); ?>">
  </div>

  <div>
    <label for="content">content</label>
    <textarea name="content" rows="4" cols="40" id="content" placeholder="content"><?= $content; ?></textarea>
  </div>

  <div>
    <label for="published_at">when it were posted init</label>
    <input type="datetime-local" name="published_at" id="published_at" value="<?= $published_at; ?>">
  </div>

  <button>save</button>

</form>

<?php require 'includes/footer.php'; ?>
