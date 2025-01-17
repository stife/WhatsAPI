<?php
// exampleRegister.php

// Include the WhatsProt class
require_once 'whatsprot.class.php';

// Define your phone number with international prefix but without + and 00
$username = "phone number with international prefix but without + and 00";

// Generate the identity
$identity = strtolower(urlencode(sha1($username, true)));

// Create a new instance of WhatsProt
$w = new WhatsProt($username, $identity, "Your Name", true);

// Request a code
$w->codeRequest();

// Register the code
$result = $w->codeRegister("your 6 digit SMS code");

// Retrieve the password
$password = $result->pw;
echo "Password is $password";

// Connect to WhatsApp
$w->Connect();

// Login with the password
$w->LoginWithPassword($password);

// Define the destination number with international prefix but without + and 00
$dst = 'destination number with international prefix but without + and 00';

// Define the message text
$msg = 'Your message text';

// Send the message
$w->sendMessage($dst, $msg);

// Disconnect from WhatsApp
$w->disconnect();
?>
