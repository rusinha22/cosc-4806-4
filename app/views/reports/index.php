<?php require_once 
    var_dump($_SESSION); 
require_once 'app/views/templates/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Admin Reports</h1>

    <h3>📌 All Reminders</h3>
    <ul class="list-group mb-4">
        <?php foreach ($data['reminders'] as $reminder): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($reminder['subject']) ?> 
                (User ID: <?= $reminder['user_id'] ?>)
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>🏆 User with Most Reminders</h3>
    <p>
        <?= htmlspecialchars($data['mostReminders']['username']) ?> 
        (<?= $data['mostReminders']['count'] ?> reminders)
    </p>

    <h3>📈 Login Counts</h3>
    <ul class="list-group">
        <?php foreach ($data['loginCounts'] as $row): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($row['username']) ?>: <?= $row['logins'] ?> logins
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
