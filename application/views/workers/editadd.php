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
            echo HTML::anchor('workers', 'Lista Pracowników');
            if($msg!=='')echo"<h3>".$msg."</h3>";
            //check which form should be show: add or edit
            if(strpos(Request::current()->uri(),'edit'))
            echo form::open('workers/edit',  array ('method'=>'post'));
            else echo form::open('workers/add',  array ('method'=>'post'));?>
            <table>
                <tr><td>Imię: </td><td><?php echo form::input('imie', $worker->imie); ?></td></tr>
                <tr><td>Nazwisko: </td><td><?php echo form::input('nazwisko', $worker->nazwisko); ?></td></tr>
                <tr><td>Stanowisko: </td><td><?php echo form::input('stanowisko', $worker->stanowisko); ?></td></tr>
                <tr><td>Pesel: </td><td><?php echo form::input('pesel', $worker->pesel); ?></td></tr>
                <?php echo form::hidden('idworkerses',$worker->idworkerses); ?>
            </table>
            
            <?php if(strpos(Request::current()->uri(),'edit'))
            echo form::submit('submit', 'Potwierdź Edycję');
            else echo form::submit('submit', 'Dodaj Pracownika');
            echo form::close(); ?>
        </section>
    </body>
</html>