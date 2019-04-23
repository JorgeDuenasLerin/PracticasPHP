<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Prácticas de PHP</title>
  </head>
  <body>
    <h1>Prácticas de PHP</h1>
    <p>
      Realizadas por:<br>
        Carlos Fernando Calvo Gutierrez<br>
        Sergio Arribas Sanchez<br>
        Rebeca Antón Ruiz<br>
        Jorge Dueñas Lerín<br>
    </p>
    <?php foreach([2, 3, 4, 5] as $i){ ?>
      <ul>
        <li>
          DWES0<?=$i?>
          <ul>
            <li><a href="./DWES0<?=$i?>/CFCG/">CFCG</a></li>
            <li><a href="./DWES0<?=$i?>/JDL/">JDL</a></li>
            <li><a href="./DWES0<?=$i?>/RAR/">RAR</a></li>
            <li><a href="./DWES0<?=$i?>/SAS/">SAS</a></li>
          </ul>
        </li>
      </ul>
    <?php } ?>
  </body>
</html>
