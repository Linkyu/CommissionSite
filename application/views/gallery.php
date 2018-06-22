<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>KYUSART</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/js/chosen_v1.8.7/chosen.css">
</head>
<body>
<header>
    <h1>KYUSART</h1>
</header>
<div id="container">
    <div id="body">
        <div id="avatar_div"><img src="<?php echo base_url(); ?>static/images/feryuu.png"></div>


        <p id="introduction">Welcome to the gallery. You can filter and search.</p>

        <form id="gallery_search_form">
            <input type="search" placeholder="Search..." id="gallery_search_bar"/>
            <select multiple data-placeholder="Select which tags to include" id="gallery_tag_selector"
                    class="chosen-choices" title="AAA">
                <option value="sketch">Sketch</option>
                <option value="kara_qureshi">Kara Qureshi</option>
                <option value="krita">Krita</option>
                <option value="furries">Furries</option>
                <option value="3d">3D</option>
                <option value="guns">Guns</option>
            </select>
            <input type="submit" value="> Search">
        </form>

        <div id="main_galleries">
            <section class="gallery">
                <div class="thumbnail">
                    <div class="thumbnail_img_div">
                        <div class="thumbnail_star_counter">⭐ X 15</div>
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/fer1.png">
                    </div>
                    <p class="thumbnail_title">Feryuu ref sheet</p>
                </div>
                <div class="thumbnail">
                    <div class="thumbnail_img_div">
                        <div class="thumbnail_star_counter">⭐ X 7</div>
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/kara.png">
                    </div>
                    <p class="thumbnail_title">"Kara Qureshi, ready to take off!"</p>
                </div>
                <div class="thumbnail">
                    <div class="thumbnail_img_div">
                        <div class="thumbnail_star_counter">⭐ X 95</div>
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/aot.png">
                    </div>
                    <p class="thumbnail_title">Attack on Touhou</p>
                </div>
                <div class="thumbnail">
                    <p class="thumbnail_date">yesterday</p>
                    <div class="thumbnail_img_div">
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/lyra.png">
                    </div>
                    <p class="thumbnail_title">Lyra scars ref</p>
                </div>
                <div class="thumbnail">
                    <p class="thumbnail_date">2 days ago</p>
                    <div class="thumbnail_img_div">
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/kara2.png">
                    </div>
                    <p class="thumbnail_title">Underwater infiltration aaaaaaaaaaaaaaa a aaa a a a a a a aaaa</p>
                </div>
                <div class="thumbnail">
                    <p class="thumbnail_date">4 days ago</p>
                    <div class="thumbnail_img_div">
                        <img src="<?php echo base_url(); ?>static/images/PH_thumbnails/fer2.png">
                    </div>
                    <p class="thumbnail_title">Sketchavember day 27: Ult</p>
                </div>
            </section>
        </div>
    </div>
    <nav id="menu">
        <a class="menu_tab">Main page</a>
        <a class="menu_tab">Gallery</a>
        <a class="menu_tab">Commission details</a>
        <a class="menu_tab">Terms and conditions</a>
        <a class="menu_tab">Contact</a>
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
    $(".chosen-choices").chosen()
</script>
</body>
</html>