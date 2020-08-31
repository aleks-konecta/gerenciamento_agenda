<?php header('Content-Type: text/html; iso-8859-1');?>
<?php
$data = $_POST['data'];
$hora_ini = $_POST['hora_ini'];
$hora_fim = $_POST['hora_fim'];
$tipo = $_POST['tipo'];
$tipo_ajax = $_POST['tipo_ajax'];

require 'conn.php';

if($tipo_ajax == "alterar") {
    $agenda_id = $_POST['agenda_id'];
    $query = $conn->prepare("SELECT COUNT(*) FROM `agenda` WHERE agenda_id <> '".$agenda_id."' AND data_cri = '".$data."' AND (hora_ini = '".$hora_ini."' OR hora_fim >= '".$hora_ini."') AND tipo = '".$tipo."' ");
}else{
    $query = $conn->prepare("SELECT COUNT(*) FROM `agenda` WHERE data_cri = '".$data."' AND (hora_ini = '".$hora_ini."' OR hora_fim >= '".$hora_ini."') AND tipo = '".$tipo."' ");
}

$query->execute();

while($fetch = $query->fetch()){
    if($fetch['COUNT(*)'] >= 1){
        echo "OK";
    }else{
        echo "NOK";
    }
}
exit();
?>
