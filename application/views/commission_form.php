<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Linkyu's art page</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/js/chosen_v1.8.7/chosen.css">
</head>
<body>
<header>
    <h1>LINKYU'S ART PAGE</h1>
</header>
<div id="container">
    <div id="body">
        <div id="avatar_div"><img src="<?php echo base_url(); ?>static/images/feryuu.png"></div>

        <div id="body_container">
            <h2>Commission form</h2>

            <div id="error_div">
                <?php echo validation_errors(); ?>
            </div>
            <?php if (isset($sent_flag)): ?>
                <p id="info_div">Thank you! Your commission request has been sent successfully!</p>
            <?php endif; ?>

            <?php echo form_open('main/contact', 'id = "commission_form"'); ?>
                <div id="no">
                    <div class="flex_div">
                        <label><h3>Category</h3>
                            <select data-placeholder="Select which category" name="category">
                                <option value="sketch">Sketch</option>
                                <option value="flats">Flats</option>
                                <option value="shaded">Shaded</option>
                                <option value="painting">Painting</option>
                                <option value="other">Other</option>
                            </select>
                        </label>
                        <label><h3>Scope (if applicable)</h3>
                            <select data-placeholder="Select which scope" name="scope">
                                <option value="na">N/A</option>
                                <option value="portrait">Portrait</option>
                                <option value="bust">Bust</option>
                                <option value="fullbody">Full-body</option>
                            </select>
                        </label>
                    </div>
                    <div class="flex_div">
                        <label><h3>Name</h3>
                            <input type="text" name="name" value="<?php if (isset($name)) {echo $name;} ?>">
                        </label>
                        <label><h3>Email</h3>
                            <input type="email" name="email" value="<?php if (isset($email)) {echo $email;} ?>">
                        </label>
                    </div>
                    <label><h3>Description</h3>
                        <textarea name="description"><?php if (isset($message)) {echo $message;} else {echo "Please include references";} ?></textarea>
                    </label>
                    <input type="checkbox" id="terms_agreed_checkbox" name="terms_agreed">
                    <label for="terms_agreed_checkbox">By checking this box, I agree to the <a href="<?php echo site_url('Main/terms') ?>">terms and conditions</a></label>
                </div>
                <input type="submit" value="Send commission details!">
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
<script src="<?php echo base_url(); ?>static/js/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>static/js/chosen_v1.8.7/chosen.jquery.js"></script>
<script>
    $(".chosen-select").chosen()
</script>
</body>
</html>