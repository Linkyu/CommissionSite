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
                    <p class="center">⭐ X <span id="star_counter_number"><?php echo $art->star_count ?></span></p>
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
    <p class="footer">AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>
</footer>
<script src="<?php echo base_url(); ?>static/js/jquery-3.3.1.js"></script>
<script type="text/javascript">
    $("#star_button").click(function(){
        $.ajax({
            url: "<?php echo site_url('Main/star') ?>",
            type: "POST",
            data: {
                ip: "<?php echo $ip ?>",
                art_id: <?php echo $art->id ?>
            },
            datatype: "json",
            success: function(result){
                update_star_counter();
            },
            error: function (message) {
                alert("You have already voted-- But thanks anyway!")
            }
        });
    });

    function update_star_counter() {
        $.ajax({
            url: "<?php echo site_url('Main/get_star_counter/' . $art->id) ?>",
            success: function (result) {
                $("#star_counter_number").text(result);
            },
            error: function (message) {
                alert(message);
            }
        })
    }
</script>
</body>
</html>