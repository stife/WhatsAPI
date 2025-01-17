##Update: May 2015

**Fed up with the f\*\*king legal threats.**

![image](https://i.imgur.com/sxmizIy.jpg)

This was started late 2011 as a research project about a popular messaging app/protocol, quickly named it WhatsAPI and open-sourced. Since then many people got invloved (in a good way: contributing, and a bad way: copying without giving proper credit, profiting off, etc...).

Among people who were involved: legal firms and counselors, sending all sorts of letters and documents, DMCA, Cease and Desist, informal threats and so on.

So besides having no time or interest for the core project anymore, and not benefiting at all, not from this or from the work derived from it, comes more aggressive letters citing lengthy Computer Fraud and Abuse Act (CFAA) clauses and requiring compensation among other ridiculous demands and/or threats.

*I'm wiping this repository away.*

## Instructions for Obtaining a WhatsApp Password Using the API

### Phase 1: Request Code

```php
$username = "phone number with international prefix but without + and 00";
$identity = strtolower(urlencode(sha1($username, true)));
$w = new WhatsProt($username, $identity, "Your Name", true);
$w->codeRequest();
```

### Phase 2: Retrieve Password

```php
$username = "phone number with international prefix but without + and 00";
$identity = strtolower(urlencode(sha1($username, true)));
$w = new WhatsProt($username, $identity, "Your Name", true);
$result = $w->codeRegister("your 6 digit SMS code");
$password = $result->pw;
echo "Password is $password";
```

### Phase 3: Send Message

```php
$username = "phone number with international prefix but without + and 00";
$identity = strtolower(urlencode(sha1($username, true)));
$w = new WhatsProt($username, $identity, "Your Name", true);
$password = 'YourPassword';
$w->Connect();
$w->LoginWithPassword($password);

$dst = 'destination number with international prefix but without + and 00';
$msg = 'Your message text';
$w->sendMessage($dst, $msg);
$w->disconnect();
```

### Note

You need to enable the `php_curl` extension in your PHP configuration.
