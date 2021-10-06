<?php

print_r($_POST['tipo']);
print_r($_POST['cpf']);

if($_POST['tipo']=='Tipo_del'){
    //deleta pelo CPF
    echo 'DELETAR BD';
}
if($_POST['tipo']=="Tipo_proc"){
    //procura pelo CPF
    echo 'PROCURAR BD';
}
if($_POST['tipo']=='Tipo_ins'){
    //insere novo dado
    echo 'INSERIR BD';
}
if(isset($_POST['Nok'])){
    // cancela 
    echo 'CANCELADO';
    include('index.php');
}
?>

<p><a href="index.php">Voltar ao menu inicial!</a> </p>