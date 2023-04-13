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

    public function registrarEncomendas(Request $get) {
        $clientes = clientes::all();
        $produtos = produtos::all();
        $salvo = $get->get('registrado');

        return view('registrarEncomendas', ['clientes' => $clientes, 'produtos' => $produtos, 'salvo' => $salvo]);
    }

    public function salvarEncomendas(Request $post) {
        $pedidos = new pedidos();

        $preco = str_replace('.', '', $post->valor_frete);
        $preco = str_replace(',', '.', $preco);

        $pedidos->id_cliente = $post->cliente;
        $pedidos->id_produto = $post->produto;
        $pedidos->local_partida = $post->local_partida;
        $pedidos->local_destino = $post->local_destino;
        $pedidos->valor_frete = $preco;
        $pedidos->data_entrega = date('Y-m-d', strtotime($post->data_entrega));
        $pedidos->descricao = $post->descricao;

        $pedidos->save();

        return redirect('/registrarEncomendas?registrado=1');
    }

    public function encomendas() {
        $pedidos = pedidos::all();

        $clientes = [];
        $produtos = [];

        $clientes[0] = 'Cliente não registrado';
        $produtos[0] = 'Produto não registrado';
        foreach($pedidos as $pedido) {
            // para que não seja feita conexões com o banco desnecessárias, as informações são gravas em arrays
            if(!isset($clientes[$pedido->id_cliente])) {
                $cliente = clientes::where('id', '=', $pedido->id_cliente)->first();

                $clientes[$pedido->id_cliente] = $cliente->nome;
            }
            if(!isset($produtos[$pedido->id_produto])) {
                $produto = produtos::where('id', '=', $pedido->id_produto)->first();

                $produtos[$pedido->id_produto] = $produto->nome;
            }

            // os IDs são substituidos pelos nomes
            $pedido->id_cliente = $clientes[$pedido->id_cliente];
            $pedido->id_produto = $produtos[$pedido->id_produto];

            $data = explode('-', $pedido->data_entrega);
            $pedido->data_entrega = $data[2] . '/' . $data[1] . '/' . $data[0];
        }

        return view('encomendas', ['pedidos' => $pedidos]);
    }
}
