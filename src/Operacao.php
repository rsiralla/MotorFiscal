<?php

namespace MotorFiscal;

class Operacao extends Base
{
	public $identificador;
	public $CFOPMercadoria;
	public $NaturezaOperacao;/*Descriчуo*/
	public $CFOPMercadoriaST;
	public $CFOPMercadoriaSTSubstituido;
	public $CFOPProduto;
	public $CFOPProdutoST;
	public $TipoOperacao;
	public $identificacao;
	public $finalidade;
	public $indFinal;
	public $indPres;
	
	
	public function isDevolucao($cfop)
	{
		$cfop_devolucao = [
			'1202',
			'1203',
			'1204',
			'1208',
			'1209',
			'1410',
			'1411',
			'1503',
			'1504',
			'1505',
			'1506',
			'1553',
			'1660',
			'1661',
			'1662',
			'1918',
			'1919',
			'2201',
			'2202',
			'2203',
			'2204',
			'2208',
			'2209',
			'2410',
			'2411',
			'2503',
			'2504',
			'2505',
			'2506',
			'2553',
			'2660',
			'2661',
			'2662',
			'2918',
			'2919',
			'3201',
			'3202',
			'3211',
			'3503',
			'3553',
			'5201',
			'5202',
			'5208',
			'5209',
			'5210',
			'5410',
			'5411',
			'5412',
			'5413',
			'5503',
			'5553',
			'5555',
			'5556',
			'5660',
			'5661',
			'5662',
			'5918',
			'5919',
			'5921',
			'6201',
			'6202',
			'6208',
			'6209',
			'6210',
			'6410',
			'6411',
			'6412',
			'6413',
			'6503',
			'6553',
			'6555',
			'6556',
			'6660',
			'6661',
			'6662',
			'6918',
			'6919',
			'6921',
			'7201',
			'7202',
			'1201',
			'7210',
			'7211',
			'7553',
			'7556'
		];
		$cfop           = trim(str_replace('.', '', $cfop));
		
		return in_array($cfop, $cfop_devolucao);
	}
	
	
	/**
	 * Campos com chave para pesquisa do produto no banco de dados.
	 */
	
}