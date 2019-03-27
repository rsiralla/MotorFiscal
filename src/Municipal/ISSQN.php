<?php

namespace MotorFiscal\Municipal;

use MotorFiscal\Base;

/**
 * Classe com todas as informaчѕes para escrituraчуo do ISSQN
 */
class ISSQN extends Base
{
	/**
	 * NF-e/NFC-e : U01 - ISSQN
	 */
	public $ISSQN;
	/**
	 * NF-e/NFC-e : U02 - vBC
	 */
	public $vBC;
	/**
	 * NF-e/NFC-e : U03 - vAliq
	 */
	public $vAliq;
	/**
	 * NF-e/NFC-e : U04 - vISSQN
	 */
	public $vISSQN;
	/**
	 * NF-e/NFC-e : U05 - cMunFG
	 */
	public $cMunFG;
	/**
	 * NF-e/NFC-e : U06 - cListServ
	 */
	public $cListServ;
	/**
	 * NF-e/NFC-e : U07 - vDeducao
	 */
	public $vDeducao = 0;
	/**
	 * NF-e/NFC-e : U08 - vOutro
	 */
	public $vOutro = 0;
	/**
	 * NF-e/NFC-e : U09 - vDescIncond
	 */
	public $vDescIncond = 0;
	/**
	 * NF-e/NFC-e : U10 - vDescCond
	 */
	public $vDescCond;
	public $vISSRet;
	/**
	 * NF-e/NFC-e : U12 - indISS
	 */
	public $indISS;
	/**
	 * NF-e/NFC-e : U13 - cServico
	 */
	public $cServico;
	/**
	 * NF-e/NFC-e : U14 - cMun
	 */
	public $cMun;
	/**
	 * NF-e/NFC-e : U15 - cPais
	 */
	public $cPais;
	/*
	 * NF-e/NFC-e : U11 - vISSRet
	 */
	/**
	 * NF-e/NFC-e : U16 - nProcesso
	 */
	public $nProcesso;
	/**
	 * NF-e/NFC-e : U17 - indIncentivo
	 */
	public    $indIncentivo;
	protected $vRetPIS = 0;
	protected $vRetCOFINS = 0;
	protected $vRetIR     = 0;
	protected $vRetCSLL   = 0;
	protected $vRetINSS   = 0;
	
}
