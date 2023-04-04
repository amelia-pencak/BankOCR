<!DOCTYPE html>
<html>
    <head>
        <title>Bank OCR</title>
    </head>
    <body>
    <form action="stronaPierwsza.php?test=wczytaniePliku" enctype="multipart/form-data" method="post" class="form-example">
    <div class="form-example">
        <label for="name">Wybierz plik z numerami kont: </label>
    </div>
    <div class="form-example">
        <input type="file" name="plikDanych[]" id="file" multiple accept=".txt">
        <input type="submit" name="przycisk" value="sprawdz wynik!">
    </div>
    </form>
    </body>
</html>
<?php
    require_once("index.php"); //
    echo "wynik obliczony <br/>";
   