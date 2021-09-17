<?php include "includes/header.php" ?>         
   
      
      <!-- /.card-header -->
      <div class="card-body">
        <?php
          $query="";
            if (isset($_POST['consulta'])) {
                // If executing query..
                $query = 'analizar(['.$_POST['query'].','.$_POST['query1'].','.$_POST['query2'].','.$_POST['query3'].','.$_POST['query4'].'])';
            } else {
                // If executing main..
              /*   $query = "main."; */
            }
            $lastLine = exec('swipl -s index.pl -g "'.$query.'" -t halt.', $output, $returnValue);

        ?>

        <h2>Resultado de consultar ?- <?= $query ?></h2>
        <div style="border: 1px dashed black; width: 90%; padding-left: 12px; padding-right: 12px;">
            <pre><?php
            foreach ($output as $line) {
                echo $line.'<br>';
            }
            ?></pre>
            <?php //var_dump($output) ?>
            <p>Valor de retorno: <?= $returnValue ?> <?php
            if($returnValue == 0) echo 'true';
            elseif($returnValue == 1) echo 'false';
            elseif($returnValue == 2) echo 'error';
            ?> - Última línea: <?= $lastLine ?></p>
        </div>

        <h2>Hacer consulta simple</h2>
        <form method="post">
        <input type="text" style="width: 75%;" name="query">
        <input type="text" style="width: 75%;" name="query1">
        <input type="text" style="width: 75%;" name="query2">
        <input type="text" style="width: 75%;" name="query3">
        <input type="text" style="width: 75%;" name="query4">
        <input type="submit" name="consulta" value="Consultar"><br>

        </form>

      </div>
      <!-- /.card-body -->
 
<?php include "includes/footer.php" ?>