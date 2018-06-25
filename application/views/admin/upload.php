<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Linkyu's art page</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/icon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/jcrop/jquery.Jcrop.css" type="text/css" />
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
                            <input type="text">
                        </label>
                        <label>File
                            <input type="file" onchange="previewFile()" id="upload_file_input">
                        </label>
                        <label>Description
                            <textarea></textarea>
                        </label>
                        <br>
                        <h2>Stats:</h2>
                        <label>Time spent
                            <input type="text">
                        </label>
                        <label>Software
                            <input type="text">
                        </label>
                        <label>Amount of layers
                            <input type="text">
                        </label>
                        <label>Commission?
                            <input type="checkbox">
                        </label>
                        <label>Price
                            <input type="text">
                        </label>
                    </div>
                    <div>
                        <label>Thumbnail
                            <img src="" height="200" id="thumbnail_maker" alt="Image preview...">
                        </label>
                    </div>
                </div>
                <input type="submit" value="Upload">
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
<script src="<?php echo base_url(); ?>static/js/jquery-3.3.1.js"></script>
<script src="<?php echo base_url(); ?>static/js/jcrop/jquery.Jcrop.js"></script>
<script src="<?php echo base_url(); ?>static/js/jcrop/jquery.color.js"></script>
<script type="text/javascript">
    function previewFile() {
        var preview = document.querySelector('#thumbnail_maker');
        var file    = document.querySelector('#upload_file_input').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }

        create_jcrop();
    }

    // The variable jcrop_api will hold a reference to the
    // Jcrop API once Jcrop is instantiated.
    var jcrop_api;

    function create_jcrop() {
        jQuery(function($){
            $('#thumbnail_maker').Jcrop({
                onRelease: releaseCheck
            },function(){

                jcrop_api = this;
                jcrop_api.animateTo([100,100,400,300]);

                // Setup and dipslay the interface for "enabled"
                $('#can_click,#can_move,#can_size').attr('checked','checked');
                $('#ar_lock,#size_lock,#bg_swap').attr('checked',false);
                $('.requiresjcrop').show();

            });
        });
    }

    // This function is bound to the onRelease handler...
    // In certain circumstances (such as if you set minSize
    // and aspectRatio together), you can inadvertently lose
    // the selection. This callback re-enables creating selections
    // in such a case. Although the need to do this is based on a
    // buggy behavior, it's recommended that you in some way trap
    // the onRelease callback if you use allowSelect: false
    function releaseCheck()
    {
        jcrop_api.setOptions({ allowSelect: true });
    }
</script>
</body>
</html>