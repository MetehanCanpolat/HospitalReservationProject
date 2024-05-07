<?php
      session_start();
      session_unset(); // Oturum değişkenlerini temizle
      session_destroy();
      header("Location: index.php");
      exit;
?>