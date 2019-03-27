<?php

namespace MotorFiscal;

/**
 * Classe com todas as infromações do destinatario
 */
class Emitente extends Base
{
	public $PercCreditoSimples;
	public $identificador;
	public $ContribuinteIPI;
	/**
	 * NF-e/NFC-e :C02 - CNPJ
	 */
	public $CNPJ;
	/**
	 * NF-e/NFC-e :C02a - CPF
	 */
	public $CPF;
	/**
	 * NF-e/NFC-e :C03 - xNome
	 */
	public $xNome;
	/**
	 * NF-e/NFC-e :C04 - xFant
	 */
	public $xFant;
	
	/**
	 * NF-e/NFC-e : C06 - xLgr
	 */
	public $xLgr;
	
	/**
	 * NF-e/NFC-e : C07 - nro
	 */
	public $nro;
	
	/**
	 * NF-e/NFC-e : C08 - xCpl
	 */
	public $xCpl;
	
	/**
	 * NF-e/NFC-e : C09 - xBairro
	 */
	public $xBairro;
	/**
	 * NF-e/NFC-e : C10 - cMun
	 */
	public $cMun;
	/**
	 * NF-e/NFC-e : C11 - xMun
	 */
	public $xMun;
	/**
	 * NF-e/NFC-e : C12 - UF
	 */
	public $UF;
	/**
	 * NF-e/NFC-e : C13 - CEP
	 */
	public $CEP;
	/**
	 * NF-e/NFC-e : C14 - cPais
	 */
	public $cPais;
	/**
	 * NF-e/NFC-e : C15 - xPais
	 */
	public $xPais;
	/**
	 * NF-e/NFC-e : C16 - fone
	 */
	public $fone;
	/**
	 * NF-e/NFC-e : C17 - IE
	 */
	public $IE;
	/**
	 * NF-e/NFC-e : C18 - IEST
	 */
	public $IEST;
	/**
	 * NF-e/NFC-e : C19 - IM
	 */
	public $IM;
	/**
	 * NF-e/NFC-e : C20 - CNAE
	 */
	public $CNAE;
	/**
	 * NF-e/NFC-e : C21 - CRT
	 */
	public $CRT;
	
	public $num_versao_ibpt;
	public $id_estado;
	public $id_cidade;
}