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
    <h1>KYUSART</h1>
</header>
<div id="container">
    <div id="body">


        <p id="introduction">Hello, and welcome to my public art page! I am currently taking commissions, and this is
            where you can find all the info you might need about it. If you already know what you want and what price to
            expect for it, there is a form at the bottom of this page to contact me for the commission.</p>

        <div id="main_galleries">
            <h2 class="section_heading" id="featured_heading">⭐ Featured</h2>
            <section id="featured_section" class="mini_gallery">
                <?php foreach ($featured as $art): ?>
                    <div class="thumbnail">
                        <a href="<?php echo site_url('Main/art/' . $art->id) ?>">
                            <div class="thumbnail_img_div">
                                <div class="thumbnail_star_counter">⭐ X <?php echo $art->star_count; ?></div>
								<img
										class="thumbnail_source_image"
										src="<?php echo base_url(); ?>static/images/uploads/thumbnails/<?php echo $art->filename; ?>"
										alt="<?php echo $art->title; ?>"
										id="<?php echo "art_image_" . $art->id ?>"
										width="256"
										height="256"
										data-id="<?php echo $art->id ?>"
										data-coordinates="<?php echo $art->thumbnail ?>"
								/>
                            </div>
                            <p class="thumbnail_title"><?php echo $art->title; ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </section>

            <h2 class="section_heading" id="latest_heading">🕑 Latest</h2>
            <section id="latest_section" class="mini_gallery">
                <?php foreach ($latest as $art): ?>
                    <div class="thumbnail">
                        <a href="<?php echo site_url('Main/art/' . $art->id) ?>">
                            <p class="thumbnail_date"><?php echo $art->date; ?></p>
                            <div class="thumbnail_img_div">
								<img
										class="thumbnail_source_image"
										src="<?php echo base_url(); ?>static/images/uploads/thumbnails/<?php echo $art->filename; ?>"
										alt="<?php echo $art->title; ?>"
										id="<?php echo "art_image_" . $art->id ?>"
										width="256"
										height="256"
										data-id="<?php echo $art->id ?>"
										data-coordinates="<?php echo $art->thumbnail ?>"
								/>
                            </div>
                            <p class="thumbnail_title"><?php echo $art->title; ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </section>
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
</body>
</html>
