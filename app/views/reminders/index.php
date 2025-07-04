<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
  <div class="page-header" id="banner">
    <div class="row">
      <div class="col-lg-12">
        <h1>Reminders</h1>
        <p> <a
        <p> <a href="/reminders/create">Create a new reminder</a></p>
      </div>
    </div>
  </div>

          <?php
  foreach ($data['reminders'] as $reminder){
  echo "<p>" . $reminder['subject']. ' <a href="/reminder/update">update</a> delete</p>';
}
?>
<?php require_once app/views/templates/footer.php ?>
      