<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\clientes;
use App\Models\produtos;
use App\Models\pedidos;

class EventController extends Controller
{
    public function index() {
        return view('index');
    }

    // ==================== Pedidos =========================
    public function registrarEncomendas(Request $get) {
        $clientes = $this->curl('getClientes');
        $produtos = $this->curl('getProdutos');
        $salvo = $get->get('registrado');

        return view('registrarEncomendas', ['clientes' => $clientes, 'produtos' => $produtos, 'salvo' => $salvo]);
    }

    public function salvarEncomendas(Request $post) {
        $ret = $this->curl('setPedido');

        $registrado = ($ret == 'true') ? 1 : 0;
        
        return redirect("/registrarEncomendas?registrado=$registrado");
    }

    public function encomendas() {
        $pedidos = $this->curl('getPedidos');

        $clientes = [];
        $produtos = [];
        $param = [];

        $clientes[0] = 'Cliente não registrado';
        $produtos[0] = 'Produto não registrado';
        foreach($pedidos as $key => $pedido) {
            // para que não seja feita conexões com o banco desnecessárias, as informações são gravas em arrays
            if(!isset($clientes[$pedido['id_cliente']])) {
                $cliente = $this->curl('getClientes', 'id = '.$pedido['id_cliente']);

                $clientes[$pedido['id_cliente']] = $cliente[0]['nome'];
            }
            if(!isset($produtos[$pedido['id_produto']])) {
                $produto = $this->curl('getProdutos', 'id = '.$pedido['id_produto']);

                $produtos[$pedido['id_produto']] = $produto[0]['nome'];
            }

            $data = explode('-', $pedido['data_entrega']);

            $temp = [];
            $temp['cliente']        = $clientes[$pedido['id_cliente']];
            $temp['produto']        = $produtos[$pedido['id_produto']];
            $temp['local_partida']  = $pedido['local_partida'];
            $temp['local_destino']  = $pedido['local_destino'];
            $temp['valor_frete']    = number_format($pedido['valor_frete'], 2, ',', '.');
            $temp['data_entrega']   = $data[2] . '/' . $data[1] . '/' . $data[0];
            $temp['descricao']      = $pedido['descricao'];

            $param[] = $temp;
        }

        return view('encomendas', ['pedidos' => $param]);
    }


    // ==================== Clientes =========================
    public function registrarClientes(Request $get) {
        $salvo = $get->get('registrado');

        return view('registrarCllientes', ['salvo' => $salvo]);
    }

    public function salvarClientes(Request $post) {
        $ret = $this->curl('setCliente');

        $registrado = ($ret == 'true') ? 1 : 0;

        return redirect("/registrarClientes?registrado=$registrado");
    }

    public function relatorioClientes() {
        $clientes = $this->curl('getClientes');
        $param = [];

        if(is_array($clientes) && count($clientes) > 0) {
            foreach($clientes as $cliente) {
                $data = explode('-', $cliente['aniversario']);

                $temp = [];
                $temp['nome']           = $cliente['nome'];
                $temp['endereco']       = $cliente['endereco'];
                $temp['aniversario']    = $data[2] . '/' . $data[1] . '/' . $data[0];
                $temp['cpf']            = $cliente['cpf'];
                $temp['rg']             = $cliente['rg'];

                $param[] = $temp;
            }
        }

        return view('relatorioClientes', ['clientes' => $param]);
    }

    private function curl($operacao, $where = '') {
        $ret = array();
        $chave = md5('clienteEmPrimeiroLugar');

        $post = array(
            'chave' => $chave,
            'operacao' => $operacao,
            ($_POST ?? ''),
            'where' => $where
        );
        $post = json_encode($post);

        $url = "http://localhost/apis/api.php";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Content-Length: ' . strlen($post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $resposta = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if(in_array($httpCode, array(200, 201, 202))){
            if($resposta != ''){
                $ret = json_decode($resposta, true);
            }
        }
        curl_close($ch);

        return $ret;
    }
}
