<?php
require_once('conexaoSql.php');

$chave = md5('clienteEmPrimeiroLugar');

$json = file_get_contents('php://input');
$post = json_decode($json, true);

if($chave == $post['chave']) {
    $db = new db();

    switch($post['operacao']) {
        case 'salvarPedido':
            $form = $post[0];

            $valor_frete = str_replace('.', '', $form['valor_frete']);
            $valor_frete = str_replace(',', '.', $valor_frete);
            $data_entrega = date('Y-m-d', strtotime($form['data_entrega']));
            
            $sql = "INSERT INTO pedidos (id_cliente, id_produto, local_partida, local_destino, valor_frete, data_entrega, descricao)
                    VALUES ('".$form['cliente']."', '".$form['produto']."', '".$form['local_partida']."', '".$form['local_destino']."', $valor_frete, '$data_entrega', '".$form['descricao']."')";
            $ret = $db->query($sql);

            if($ret) {
                echo json_encode("true");
            } else {
                echo $ret;
            }
            break;
        case 'getPedidos':
            $sql = "SELECT * FROM `pedidos`";
            $ret = $db->query($sql);

            if(!is_string($ret)) {
                echo json_encode($ret);
            } else {
                echo 'false';
            }
            break;
        case 'getClientes':
            $sql = "SELECT * FROM `clientes` WHERE ".$post['where'];
            $ret = $db->query($sql);

            if(!is_string($ret)) {
                echo json_encode($ret);
            } else {
                echo 'false';
            }
            break;
        case 'getProdutos';
            $sql = "SELECT * FROM `produtos` WHERE ".$post['where'];
            $ret = $db->query($sql);

            if(!is_string($ret)) {
                echo json_encode($ret);
            } else {
                echo 'false';
            }
            break;
    }
    
}