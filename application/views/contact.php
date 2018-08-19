<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Linkyu's art page</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
</head>
<body>
<header>
    <h1>LINKYU'S ART PAGE</h1>
</header>
<div id="container">
    <div id="body">
        <div id="avatar_div"><img src="<?php echo base_url(); ?>static/images/feryuu.png"></div>

        <div id="body_container">
            <div id="error_div">
                <?php echo validation_errors(); ?>
            </div>
            <?php if (isset($sent_flag)): ?>
            <p id="info_div">Thank you! Your message has been sent successfully!</p>
            <?php endif; ?>

            <?php echo form_open('main/contact', 'id = "contact_form"'); ?>
                <div>
                    <label>Name
                        <input type="text" name="name" value="<?php if (isset($name)) {echo $name;} ?>">
                    </label>
                    <label>Email
                        <input type="email" name="email" value="<?php if (isset($email)) {echo $email;} ?>">
                    </label>
                </div>
                <label>Message
                    <textarea name="message"><?php if (isset($message)) {echo $message;} ?></textarea>
                </label>
                <input type="submit" value="Send!">
            <?php echo form_close(); ?>
        </div>

    </div>
    <nav id="menu">
        <?php include "menu.php" ?>
    </nav>
</div>
<footer>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
</footer>
</body>
</html>