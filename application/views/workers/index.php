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
            <h2>Pracownicy</h2>
            <?php echo HTML::anchor("workers/add/", "Dodaj Nowego Pracownika"); ?>
            <?php if($numofworkers){?>
            <table>
                <tr><th>Imię</th><th>Nazwisko</th><th>Stanowisko</th><th>Pesel</th><th>Opcje</th></tr>
            <?php foreach ($workers as $worker) : ?>
                <tr>
                    <td><?php echo $worker->imie; ?></td>
                    <td><?php echo $worker->nazwisko; ?></td>
                    <td><?php echo $worker->stanowisko; ?></td>
                    <td><?php echo $worker->pesel; ?></td>
                    <td><?php echo HTML::anchor("workers/edit/".$worker->idworkerses, "Edytuj"); ?></td>
                </tr>

            <?php endforeach;?>
            </table>
            <?php }else echo"Brak pracowników w bazie danych!";?>
        </section>
    </body>
</html>