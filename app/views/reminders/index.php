<?php require_once 'app/views/templates/header.php'; ?>

<div class="container">
  <div class="page-header" id="banner">
    <div class="row">
      <div class="col-lg-12">
        <h1>Reminders</h1>
        <p><a class="btn btn-success" href="/reminders/create">➕ Create New Reminder</a></p>
      </div>
    </div>
  </div>

  <!-- ✅ Success/Error Alert Messages -->
  <?php if (isset($_SESSION['reminder_success'])): ?>
    <div class="alert alert-success">
      <?= $_SESSION['reminder_success']; unset($_SESSION['reminder_success']); ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['reminder_error'])): ?>
    <div class="alert alert-danger">
      <?= $_SESSION['reminder_error']; unset($_SESSION['reminder_error']); ?>
    </div>
  <?php endif; ?>

  <!-- ✅ List of reminders -->
  <?php if (!empty($data['reminders'])): ?>
    <?php foreach ($data['reminders'] as $reminder): ?>
      <div class="card mb-2">
        <div class="card-body">
          <p class="card-text"><?= htmlspecialchars($reminder['subject']) ?></p>
          <a href="/reminders/edit/<?= $reminder['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
          <a href="/reminders/delete/<?= $reminder['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No reminders found.</p>
  <?php endif; ?>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
