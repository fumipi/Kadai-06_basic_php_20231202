<?php

// XSS対策用の関数
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

?>