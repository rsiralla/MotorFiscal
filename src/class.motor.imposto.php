<?php

namespace MotorFiscal;
require_once "class.motor.base.php";
require_once "class.motor.icms.php";
require_once "class.motor.ipi.php";
require_once "class.motor.issqn.php";
require_once "class.motor.piscofins.php";


class Imposto extends Base
{
	public function __construct()
	{
		$this->ICMSUFDest = null;
	}
	
	
	/**
	 * NF-e/NFC-e :M02 - vTotTrib
	 */
	Public $vTotTrib;
	/**
	 * vTotTribFederal
	 */
	Public $vTotTribFederal;
	
	/**
	 * vTotTribEstadual
	 */
	Public $vTotTribEstadual;
	
	/**
	 * vTotTribMunicipal
	 */
	Public $vTotTribMunicipal;
	
	/**
	 * NF-e/NFC-e :N01 - ICMS
	 * @var \MotorFiscal\ICMS
	 */
	Public $ICMS;
	/**
	 * NF-e/NFC-e :NA01 - ICMSUFDest
	 * @var \MotorFiscal\ICMSUFDest
	 */
	
	Public $ICMSUFDest;
	
	/**
	 * NF-e/NFC-e :O01 - IPI
	 */
	Public $IPI;
	
	/**
	 * NF-e/NFC-e :P01 - II
	 */
	Public $II;
	
	/**
	 * NF-e/NFC-e :Q01 - PIS
	 */
	Public $PIS;
	
	/**
	 * NF-e/NFC-e :S01 - COFINS
	 */
	Public $COFINS;
	
	/**
	 * NF-e/NFC-e :U01 - ISSQN
	 */
	Public $ISSQN;
	
}

