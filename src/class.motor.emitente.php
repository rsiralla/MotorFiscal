<?php

namespace MotorFiscal;
require_once "class.motor.base.php";

/**
 * Classe com todas as infromações do destinatario
 */
class Emitente extends Base
{
    /**
     * NF-e/NFC-e :C02 - CNPJ
     */
    Public $CNPJ;
    /**
     * NF-e/NFC-e :C02a - CPF
     */
    Public $CPF;
    /**
     * NF-e/NFC-e :C03 - xNome
     */
    Public $xNome;
    /**
     * NF-e/NFC-e :C04 - xFant
     */
    Public $xFant;
    /**
     * NF-e/NFC-e : C06 - xLgr
     */
    Public $xLgr;
    /**
     * NF-e/NFC-e : C07 - nro
     */
    Public $nro;
    /**
     * NF-e/NFC-e : C08 - xCpl
     */
    Public $xCpl;
    /**
     * NF-e/NFC-e : C09 - xBairro
     */
    Public $xBairro;
    /**
     * NF-e/NFC-e : C10 - cMun
     */
    Public $cMun;
    /**
     * NF-e/NFC-e : C11 - xMun
     */
    Public $xMun;
    /**
     * NF-e/NFC-e : C12 - UF
     */
    Public $UF;
    /**
     * NF-e/NFC-e : C13 - CEP
     */
    Public $CEP;
    /**
     * NF-e/NFC-e : C14 - cPais
     */
    Public $cPais;
    /**
     * NF-e/NFC-e : C15 - xPais
     */
    Public $xPais;
    /**
     * NF-e/NFC-e : C16 - fone
     */
    Public $fone;
    /**
     * NF-e/NFC-e : C17 - IE
     */
    Public $IE;
    /**
     * NF-e/NFC-e : C18 - IEST
     */
    Public $IEST;
    /**
     * NF-e/NFC-e : C19 - IM
     */
    Public $IM;
    /**
     * NF-e/NFC-e : C20 - CNAE
     */
    Public $CNAE;
    /**
     * NF-e/NFC-e : C21 - CRT
     */
    Public $CRT;
    protected $PercCreditoSimples;
    protected $identificador;
    protected $ContribuinteIPI;
}