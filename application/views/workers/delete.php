<?php defined('SYSPATH') or die('No direct script access.'); ?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $header;?></title>
        <meta name="author" content="Piekarz" />
        <?php echo HTML::style('/application/views/main.css'); ?>
    </head>
    <body>
        <section>
            <h2><?php echo $header; ?></h2>
            <?php
            echo"<h3>".$msg."</h3>";
            echo HTML::anchor('workers', 'Lista Pracowników');
            ?>

        </section>
    </body>
</html>