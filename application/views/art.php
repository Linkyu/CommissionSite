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
    <div id="body" class="art_page">
        <div id="avatar_div"><img src="<?php echo base_url(); ?>static/images/feryuu.png"></div>

        <div id="body_container">
            <h1>Title of the art<span id="title_art_id"> <?php echo $id ?></span></h1>

            <div id="art_full_img"><img src="<?php echo base_url(); ?>static/images/commissions.png"></div>

            <div id="art_details_div">
                <div id="art_description_div">
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam id commodo nisi, ut ornare felis. Sed consectetur eros accumsan orci rhoncus consectetur. Duis nec velit hendrerit, tempor dolor non, rhoncus dolor. Proin sed lobortis ante. Suspendisse in est non lorem tincidunt elementum. Integer a ultrices nisi. Morbi ante nisl, rutrum quis dapibus tristique, consectetur ut sem. Donec eleifend a leo non porta.<br />
                        Maecenas interdum nunc erat, at sagittis augue aliquam id. Nam ac lacus nisl. Nullam non tortor quam. Sed laoreet diam sed metus egestas dapibus ac et arcu. Mauris sem ligula, porta ut posuere eleifend, cursus sed mauris. Nulla facilisi. Morbi ultrices tincidunt dapibus. Suspendisse commodo aliquam tincidunt.</p></div>
                <div id="art_data_div">
                    <div id="art_stars_div"><div id="star_button">⭐ +1!</div></div>
                    <hr>
                    <div id="art_stats_div">
                        <p class="art_stat_label">Time spent</p>
                        <p class="art_stat_value">about 3 hours</p>
                        <p class="art_stat_label">Software</p>
                        <p class="art_stat_value">Krita</p>
                        <p class="art_stat_label">Layers</p>
                        <p class="art_stat_value">3</p>
                    </div>
                </div>
            </div>
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