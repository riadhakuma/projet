<?php
session_start();/*selectionne la session kichghol*/
session_destroy(); /* Ferme la session*/
header("Location: index.php");
?>