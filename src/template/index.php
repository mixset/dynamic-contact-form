<?php

require 'partials/header.php';

if (isset($_POST['save'])) {
    (new \Core\Contact())->send();
}

require 'partials/messages.php';

require 'pages/index.php';

unset($_SESSION['message']);

require 'partials/footer.php';
