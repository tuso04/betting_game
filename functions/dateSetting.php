<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date'])) {
    $date = $_POST['date'];
    $_SESSION['selected_date'] = $date;
    echo "selected_date: ". $_SESSION['selected_date'];
} else {
    echo "No date selected.";
}
?>