<?php require_once 'app/views/templates/header.php'; ?>
<div class="container">
    <h2>Create Reminder</h2>
    <form method="post" action="/reminders/store">
        <div class="form-group">
            <label for="subject">Reminder:</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Reminder</button>
    </form>
</div>
<?php require_once 'app/views/templates/footer.php'; ?>
<!-- View: Create Reminder Form - Allows user to input and submit a new reminder -->
