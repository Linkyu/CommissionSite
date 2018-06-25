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

            <form id="upload_form">
                <div id="upload_inputs_div">
                    <div>
                        <label>Title
                            <input>
                        </label>
                        <label>File
                            <input>
                        </label>
                        <label>Time spent
                            <input>
                        </label>
                        <label>Software
                            <input>
                        </label>
                        <label>Amount of layers
                            <input>
                        </label>
                        <label>Price
                            <input>
                        </label>
                        <label>Description
                            <textarea></textarea>
                        </label>
                    </div>
                    <div>
                        <label>Thumbnail
                            <input>
                        </label>
                    </div>
                </div>
                <input type="submit">
            </form>
        </div>

    </div>
    <nav id="menu">
<!--     <?php //include "../menu.php" ?>   -->
    </nav>
</div>
<footer>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
</footer>
</body>
</html>