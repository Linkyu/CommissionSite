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
            <h2>Upload art</h2>

            <form id="upload_form">
                <div id="upload_inputs_div">
                    <div>
                        <label><h3>Category</h3>
                            <select data-placeholder="Select which category" class="chosen-select" title="AAA">
                                <option value=""></option>
                                <option value="sketch">Sketch</option>
                                <option value="kara_qureshi">Kara Qureshi</option>
                                <option value="krita">Krita</option>
                                <option value="furries">Furries</option>
                                <option value="3d">3D</option>
                                <option value="guns">Guns</option>
                            </select>
                        </label>
                        <label><h3>Description</h3>
                            <textarea></textarea>
                        </label>
                        <label><h3>Email</h3>
                            <input type="email">
                        </label>
                        <label>By checking this box, I agree to the <a href="<?php echo site_url('Welcome/terms') ?>">terms and conditions</a>
                            <input type="checkbox" id="upload_commission_checkbox">
                        </label>
                    </div>
                </div>
                <input type="submit" value="Upload">
            </form>
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