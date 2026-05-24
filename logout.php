<?php
session_start();
session_destroy(); // Ferme la session
header("Location: index.php");
?>