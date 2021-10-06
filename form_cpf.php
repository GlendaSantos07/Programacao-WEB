<html>
  <head>
    <title>PHP Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
      <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
      
    <form method="post" action="BD.php">
	<!-- elementos de digitação -->
      <p>Nome: <input type="text" name="nome" placeholder="Michel Jackson da Silva" value="<?php echo $tipo; ?>"/></p>
      <p>CPF: <input type="number" name="cpf" placeholder="123.456.789-00" value="<?php echo $cpf; ?>"/></p>
      <p><input type="submit" name="ok" value="Envia"/><input type="submit" name="Nok" value="Cancela"/></p>
		</form> 
  </body>
</html>