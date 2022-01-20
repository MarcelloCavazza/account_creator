<?php
//codigo q define sempre a sessao logged(Logado) do usuario como falsa, caso
//algum usuario tente acessar a pagina de alguma forma fora do esperado.
    session_start();
    $_SESSION['logged'] = False;

?>