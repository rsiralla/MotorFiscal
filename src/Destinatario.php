<?php

namespace MotorFiscal;
/**
 * Classe com todas as informações do destinatário
 */
class Destinatario extends Base
{
	public $identificador;
	/**
	 * NF-e/NFC-e :E02 - CNPJ
	 */
	public $CNPJ;
	/**
	 * NF-e/NFC-e :E03 - CPF
	 */
	public $CPF;
	/**
	 * NF-e/NFC-e :E03a - idEstrangeiro
	 */
	public $idEstrangeiro;
	/**
	 * NF-e/NFC-e :E04 - xNome
	 */
	public $xNome;
	public $xFant;//Variável auxiliar
	/**
	 * NF-e/NFC-e :E06 - Logradouro
	 */
	public $xLgr;
	/**
	 * NF-e/NFC-e :E07 - Número
	 */
	public $nro;
	/**
	 * NF-e/NFC-e :E08 - Complemento
	 */
	public $xCpl;
	/**
	 * NF-e/NFC-e :E09 - Bairro
	 */
	public $xBairro;
	/**
	 * NF-e/NFC-e :E10 - Código do municípioMun
	 */
	public $cMun;
	/**
	 * NF-e/NFC-e :E11 - Nome do município
	 */
	public $xMun;
	/**
	 * NF-e/NFC-e :E12 - Sigla da UF
	 */
	public $UF;
	/**
	 * NF-e/NFC-e :E13 - Código do CEP
	 */
	public $CEP;
	/**
	 * NF-e/NFC-e :E14 - Código do País
	 */
	public $cPais;
	/**
	 * NF-e/NFC-e :E15 - Nome do País
	 */
	public $xPais;
	/**
	 * NF-e/NFC-e :E16 - Telefone
	 */
	public $fone;
	/**
	 * NF-e/NFC-e :E16a - indIEDest
	 */
	public $indIEDest;
	/**
	 * NF-e/NFC-e :E17 - IE
	 */
	public $IE;
	/**
	 * NF-e/NFC-e :E18 - IEST
	 */
	public $IEST;
	/**
	 * NF-e/NFC-e :E18a - IM
	 */
	public $IM;
	/**
	 * NF-e/NFC-e :E19 - email
	 */
	public $email;
	
	
	public $tipo_cadastro;
	public $id_estado;
	public $id_cidade;
}