<?php

namespace MotorFiscal;

class Imposto extends Base
{
	/**
	 * NF-e/NFC-e :M02 - vTotTrib
	 */
	public $vTotTrib;
	/**
	 * vTotTribFederal
	 */
	public $vTotTribFederal;
	/**
	 * vTotTribEstadual
	 */
	public $vTotTribEstadual;
	/**
	 * vTotTribMunicipal
	 */
	public $vTotTribMunicipal;
	/**
	 * NF-e/NFC-e :N01 - ICMS
	 * @var \MotorFiscal\Estadual\ICMS
	 */
	public $ICMS;
	/**
	 * NF-e/NFC-e :NA01 - ICMSUFDest
	 * @var \MotorFiscal\ICMSUFDest
	 */
	
	public $ICMSUFDest;
	/**
	 * NF-e/NFC-e :O01 - IPI
	 */
	public $IPI;
	/**
	 * NF-e/NFC-e :P01 - II
	 */
	public $II;
	/**
	 * NF-e/NFC-e :Q01 - PIS
	 */
	public $PIS;
	/**
	 * NF-e/NFC-e :S01 - COFINS
	 */
	public $COFINS;
	/**
	 * NF-e/NFC-e :U01 - ISSQN
	 */
	public $ISSQN;
	
	
	public function __construct()
	{
		$this->ICMSUFDest = null;
	}
	
}

