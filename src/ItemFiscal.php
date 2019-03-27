<?php

namespace MotorFiscal;

/**
 * Classe representada pelo item H01 da NF-e/NFC-e
 */
Class ItemFiscal extends Base
{
	
	// 0 = Produto; 1 = Serviço
	/**
	 * NF-e/NFC-e :M01 - imposto
	 */
	public $imposto;
	/**
	 * NF-e/NFC-e :I01 - prod
	 */
	public $prod;
	/**
	 * NF-e/NFC-e :H02 - nItem
	 */
	public $nItem;
	/**
	 * NF-e/NFC-e :W02 - ICMSTot
	 */
	public $ICMSTot;
	/**
	 * Operação do Item da Nota Fiscal
	 */
	public  $Operacao;
	private $tipoItem = 0;
	
	
	public function __construct()
	{
		$this->imposto  = new Imposto;
		$this->prod     = new Produto;
		$this->Operacao = new Operacao;
	}
	
}
