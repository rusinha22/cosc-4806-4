<?php require_once 'app/views/templates/header.php'; ?>
<div class="container">
    <h2>Edit Reminder</h2>
    <form method="post" action="/reminders/update/<?= $data['reminder']['id'] ?>">
        <div class="form-group">
            <label for="subject">Reminder:</label>
            <input type="text" name="subject" id="subject" class="form-control"
                   value="<?= htmlspecialchars($data['reminder']['subject']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update Reminder</button>
    </form>
</div>
<?php require_once 'app/views/templates/footer.php'; ?>
<!-- edit.php: View to edit an existing reminder -->
