<?php
//Botão inserir
if(isset($_POST['inserir'])){
          //insere novo dado
          echo 'INSERIR';
          $tipo='Tipo_ins';
          envia_formulario("form_completo.html");
}else
     {
//botão deletar
if(isset($_POST['deletar'])){
    //deleta pelo CPF
    echo 'DELETAR';
    $tipo='Tipo_del';
    $cpf='1234';
    envia_formulario("form_cpf.php");
}
else{
        if(isset($_POST['modificar'])){
        echo 'MODIFICAR';
	//procura pelo cpf e modifica 
        $tipo='Tipo_mod';
       envia_formulario("form_cpf.php");
}
else{
     //recupere os valores dos campos
        
    if(isset($_POST['procurar'])){
        //procura pelo CPF
        echo 'PROCURAR';
        $tipo='Tipo_proc';
        envia_formulario("form_cpf.php");
			}
    }
 
if(isset($_POST['excluir'])){
    //recupere o valor do cpf
    $cpf=$_POST['cpf'];
    $sql = ("DELETE FROM cliente Where cpf='$cpf'");
}else{
    //recupere os valores dos campos
    //validação dos campos
    if(isset($_POST['salvar'])){
        //faça o INSERT
    }else{
       //faça o UPDATE
    }
}


  }
}

function envia_formulario($nome_arquivo){
  $file = fopen($nome_arquivo, "r");
  while(!feof($file)){
      $line = fgets($file);
      echo $line;
  }
  fclose($file);
}
?>




<?php
if($_POST["cpf"]){

        //**********conexão*********

        #Conecta banco de dados 
        $servername = "fdb30.awardspace.net";
        $database = "3640376_bdphp";
        $username = "3640376_bdphp";
        $password = "!4978Gelo";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database); 

        // Checa conexão
        if (mysqli_connect_errno())
          {
            echo "Falha na conexão MySQL: " . mysqli_connect_error();
          }

   $cpf = mysqli_real_escape_string($con, $_POST["cpf"]);
   // Inclui o arquivo com a função valida_cpf
   include('valida-cpf.php');

   // Verifica o CPF
   if ( !valida_cpf( $cpf ) ) {
      echo "CPF <span style='color:red'>" .$cpf. "</span> inváido.";
   }else{

      //verifica se existe cpf no banco
      $consulta = ("SELECT * FROM cliente Where cpf='$cpf'");
      $buscar=mysqli_query($con,$consulta);
      $dados=mysqli_fetch_array($buscar);   
      $result=mysqli_num_rows($buscar);

        if(isset($_POST['buscar'])){

            //se existir o cpf retorna os dados do banco

            if ($result===1) {
                //esses dados serão os values dos campos da tabela
                $nome = $dados["nome"];
                $telefone = $dados["telefone"];
                $modelo = $dados["modelo"];
                $aro = $dados["aro"];
                $cor = $dados["cor"];

            }else{
                echo "Registro não encontrado";
            }


        }elseif(isset($_POST['excluir'])){
            if ($result===1) {
                $delete1=mysqli_query($con,"DELETE FROM cliente Where cpf='$cpf'");
                echo "DELETE executado com sucesso!";

            }else{

                echo "DELETE não executado, CPF <span style='color:red'>" .$cpf. "</span> não encontrado";
            }

        }else{

            //recupere os valores dos campos
            $nome = mysqli_real_escape_string($con, $_POST["nome"]);
            $telefone = mysqli_real_escape_string($con, $_POST["telefone"]);
            $modelo = mysqli_real_escape_string($con, $_POST["modelo"]);
            $aro = mysqli_real_escape_string($con, $_POST["aro"]);
            $cor = mysqli_real_escape_string($con, $_POST["cor"]);

            //faça as validações dos campos aqui

            if(isset($_POST['salvar'])){
                if ($result===0) {
                    //faça o INSERT

                    $sql = 'INSERT INTO cliente (nome, cpf, telefone, modelo, aro, cor) VALUES(?, ?, ?, ?, ?, ?)';

                    $stmt = $con->prepare($sql);

                    $stmt->bind_param('ssssss', $nome, $cpf, $telefone, $modelo, $aro, $cor);
                    $stmt->execute();

                    echo "INSERT executado com sucesso!";
                }else{
                    echo "Registro com cpf= <span style='color:red'>" .$cpf. "</span>  já existente";
                }


            }else{

               if ($result===1) {
               //faça o UPDATE

                   $con->query("UPDATE cliente SET nome='$nome', cpf = '$cpf', telefone = '$telefone', modelo = '$modelo', aro = '$aro', cor = '$cor' WHERE cpf='$cpf'");

                   echo "UPDATE realizado com sucesso!";

               }else{
                    echo "UPDATE não executado, CPF <span style='color:red'>" .$cpf. "</span> não encontrado";
               }

            } //post salvar

       } //post buscar

   } // valida cpf

   mysqli_close($con);

} //post cpf
?>