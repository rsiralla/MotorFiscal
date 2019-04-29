<?php

namespace MotorFiscal;

use MotorFiscal\Estadual\ICMS;
use MotorFiscal\Federal\COFINS;
use MotorFiscal\Federal\IPI;
use MotorFiscal\Federal\PIS;
use MotorFiscal\Municipal\ISSQN;
use MotorFiscal\Estadual\ICMSTot;

/**
 * Classe representada pelo item H01 da NF-e/NFC-e
 */
Class ItemFiscal extends Base
{

    // 0 = Produto; 1 = Serviço
    /**
     * NF-e/NFC-e :M01 - imposto
     * @var Imposto
     */
    public $imposto;

    /**
     * NF-e/NFC-e :I01 - prod
     * @var Produto
     */
    public $prod;
    
    /**
     * NF-e/NFC-e :H02 - nItem
     */
    public $nItem;

    /**
     * NF-e/NFC-e :W02 - ICMSTot
     * @var ICMSTot
     */
    public $ICMSTot;
    
    /**
     * Operação do Item da Nota Fiscal
     * 
     */
    public $Operacao;
    private $tipoItem = 0;


    private function __construct()
    {

    }

    public static function criarItemFiscal(Produto $produto, Operacao $operacao, DocumentoFiscal $documento)
    {
        $item           = new ItemFiscal();
        $item->Operacao = $operacao;
        $item->prod     = $produto;
        $item->imposto  = new Imposto();

        if ($produto->tipoItem === Produto::PRODUTO) {
            $item->imposto->ICMS = new ICMS();

            //se o emitente é contribuinte do IPI
            if ($documento->emit->ContribuinteIPI) {
                $item->imposto->IPI = new IPI();
            }
        } else {
            $item->imposto->ISSQN = new ISSQN();

        }

        $item->imposto->PIS    = new PIS();
        $item->imposto->COFINS = new COFINS();

        return $item;

    }

}
