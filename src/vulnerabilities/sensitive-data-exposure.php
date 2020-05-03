<?php

  require_once "../templates/header.php";

?>

Sensitive data exposure: <br /><br />
- HTTP vs HTTPS <br />
- Weak ciphers means interceptions can crack encrypted messages (aka, through transactions) <br />
- Protocol downgrade attack. Proxy sits in the middle and downgrades connection to HTTP <br />
