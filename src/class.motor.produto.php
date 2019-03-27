<?php

namespace MotorFiscal;
/**
 * Classe representada pelo item H01 da NF-e/NFC-e
 */
Class Produto extends Base
{
	protected $identificador;
	//Variแveis para calculo do ISSQN
	protected $cMunFG       = '';
	protected $cMun         = '';
	protected $cPais        = '';
	protected $tipoItem     = 0;
	protected $cListServ    = '';
	protected $cServico     = '';
	protected $indISS       = '';
	protected $nProcesso    = '';
	protected $indIncentivo = '';
	protected $vDeducao     = '';
	protected $vDescIncond  = '';
	protected $vDescCond    = '';
	
	//dados do banco de dados
	public $TipoTributacaoIPI       = 0; /*0 = Aliquota; 1 = Quantidade*/
	public $TipoTributacaoPISCOFINS = 0; /*0 = Aliquota; 1 = Quantidade*/
	public $OrigemMercadoria        = 0;
	public $FormaAquisicao          = 0;
	/**
	 * Campos com chave para pesquisa do produto no banco de dados.
	 */
	
	//dados da NF-e
	
	/**
	 * NF-e/NFC-e :I02 - cProd
	 */
	public $cProd;
	
	
	/**
	 * NF-e/NFC-e :I03 - cEAN
	 */
	public $cEAN;
	
	
	/**
	 * NF-e/NFC-e :I04 - xProd
	 */
	public $xProd;
	
	
	/**
	 * NF-e/NFC-e :I05 - NCM
	 */
	public $NCM;
	
	
	/**
	 * NF-e/NFC-e :I05a - NVE
	 */
	public $NVE;
	
	
	/**
	 * NF-e/NFC-e :I06 - EXTIPI
	 */
	public $EXTIPI;
	
	
	/**
	 * NF-e/NFC-e :I08 - CFOP
	 */
	public $CFOP;
	
	
	/**
	 * NF-e/NFC-e :I09 - uCom
	 */
	public $uCom = 0;
	
	
	/**
	 * NF-e/NFC-e :I10 - qCom
	 */
	public $qCom = 0;
	
	
	/**
	 * NF-e/NFC-e :I10a - vUnCom
	 */
	public $vUnCom = 0;
	
	/**
	 * NF-e/NFC-e :I05c - CEST - Cรณdigo CEST
	 */
	public $CEST;
	
	/**
	 * NF-e/NFC-e :I11 - vProd
	 */
	public $vProd = 0;
	
	
	/**
	 * NF-e/NFC-e :I12 - cEANTrib
	 */
	public $cEANTrib;
	
	
	/**
	 * NF-e/NFC-e :I13 - uTrib
	 */
	public $uTrib;
	
	
	/**
	 * NF-e/NFC-e :I14 - qTrib
	 */
	public $qTrib = 0;
	
	
	/**
	 * NF-e/NFC-e :I14a - vUnTrib
	 */
	public $vUnTrib = 0;
	
	
	/**
	 * NF-e/NFC-e :I15 - vFrete
	 */
	public $vFrete = 0;
	
	
	/**
	 * NF-e/NFC-e :I16 - vSeg
	 */
	public $vSeg = 0;
	
	
	/**
	 * NF-e/NFC-e :I17 - vDesc
	 */
	public $vDesc = 0;
	
	
	/**
	 * NF-e/NFC-e :I17a - vOutro
	 */
	public $vOutro = 0;
	
	
	/**
	 * NF-e/NFC-e :I17b - indTot
	 */
	public $indTot = 1;
}