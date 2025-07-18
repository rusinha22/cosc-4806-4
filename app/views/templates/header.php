<?php
session_start();
if (!isset($_SESSION['auth'])) {
  header('Location: /login');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="/favicon.png">
    <title>COSC 4806</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/home">COSC 4806</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="nav-link" href="/home">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/reminders">Reminders</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/reminders/create">Create Reminder</a>
            </li>

            <?php if (strtolower($_SESSION['username']) === 'adminuser'): ?>
              <li class="nav-item">
                <a class="nav-link text-danger fw-bold" href="/reports">Reports</a>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link" href="/logout">Logout</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
