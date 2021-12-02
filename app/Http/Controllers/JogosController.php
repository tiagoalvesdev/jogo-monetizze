<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogos;

class JogosController extends Controller
{

    private $qtdDezenas;
    private $totalJogos;
    private $jogos = [];
    private $resultado;
    public $mensagem = '';

    public function __construct($qtdDezenas = 6, $totalJogos = 6)
    {   
        if($this->verificaRange(6,10,$qtdDezenas)){
            $this->qtdDezenas = $qtdDezenas;
            $this->mensagem = 'Sorteio realizado com sucesso!';
        }else{
            $this->mensagem = 'Erro - Quantidade de dezenas inválida.';
            return false;
        }
        $this->totalJogos = $totalJogos;
    }

    public function index()
    {
        $jogos      = $this->jogos();
        $resultado  = $this->resultados();

        return view('index', [
            'qtdDezenas'    => $this->qtdDezenas,
            'resultado'     => $this->resultado,
            'mensagem'      => $this->mensagem
        ]);
    }

    public function getJogos()
    {
        $retornoJogo = [
            'qtdDezenas'    => $this->qtdDezenas,
            'totalJogos'    => $this->totalJogos,
            'jogos'         => $this->jogos,
            'resultado'     => $this->resultado
        ];

        return $retornoJogo; 
    }

    public function setJogos($qtdDezenas,$totalJogos,$jogos,$resultado)
    {
        $this->qtdDezenas   = $qtdDezenas;
        $this->totalJogos   = $totalJogos;
        $this->jogos        = $jogos;
        $this->resultado    = $resultado;
    }

    public function jogos()
    {
        $jogosArr = [];
        for ($i=0; $i < count(array($this->totalJogos)); $i++) { 
            $jogosArr[$this->totalJogos[$i]] = $this->dezenas();
        }

        $this->jogos = $jogosArr;
    }

    public function resultados()
    {
        $rangeResultado = range(1,60);
        shuffle($rangeResultado);
        $result = array_slice($rangeResultado, 0, 6);
        array_multisort($result, SORT_ASC);

        $this->resultado = $result;
    }

    private function dezenas()
    {
        $dezenas = range(1,60);
        shuffle($dezenas);
        $result = array_slice($dezenas, 0, $this->qtdDezenas);
        array_multisort($result, SORT_ASC);

        return $result;
    }

    public function verificaRange($min, $max, $value)
    {
        return ($value >= $min && $value <= $max);
    }

}
