<?php

use ContactForm\Contact;

require 'partials/header.php';

if (isset($_POST['save'])) {
    (new Contact())->send();
}

require 'partials/messages.php';

require 'pages/index.php';

unset($_SESSION['message']);

require 'partials/footer.php';
