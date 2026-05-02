<?php
session_start();
// Limpa todas as variáveis salvas na memória do servidor
session_unset();
// Destrói a sessão ativa
session_destroy();

// Redireciona o usuário limpo para a tela de login
header("Location: login.html");
exit;