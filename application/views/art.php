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
            <h1><?php echo $art->title ?><span id="title_art_id"> <?php echo $art->id ?></span></h1>

            <div id="art_full_img"><img src="<?php echo base_url(); ?>static/images/PH_thumbnails/<?php echo $art->filename ?>"></div>

            <div id="art_details_div">
                <div id="art_description_div">
                    <p><?php echo $art->description ?></p>
                    <?php if ($art->is_commission): ?>
                        <hr/>
                        <p>This work was commissioned for $<?php echo $art->price ?>.</p>
                    <?php endif; ?>
                </div>
                <div id="art_data_div">
                    <p class="center">⭐ X <?php echo $art->star_count ?></p>
                    <div id="art_stars_div"><div id="star_button">⭐ +1!</div></div>
                    <hr>
                    <div id="art_stats_div">
                        <?php foreach ($stats as $stat): ?>
                        <p class="art_stat_label"><?php echo $stat->name ?></p>
                        <p class="art_stat_value"><?php echo $stat->value ?></p>
                        <?php endforeach; ?>
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