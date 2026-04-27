<?php
session_start();

// apaga todas as variáveis de sessão
session_unset();

// destrói a sessão
session_destroy();

// redireciona pra home
header("Location: ../index.html");
exit;
?>