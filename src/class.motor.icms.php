<?php

namespace MotorFiscal;
require_once "class.motor.base.php";

/**
 * Classe com todas as informações para escrituração do ICMS
 */
class ICMS extends Base
{

    /**
     * NF-e/NFC-e :N11 - Orig
     */
    Public $orig;

    /**
     * NF-e/NFC-e :N12 - CST
     */
    Public $CST;

    /**
     * NF-e/NFC-e :N12a - CSOSN
     */
    Public $CSOSN;

    /**
     * NF-e/NFC-e :N13 - modBC
     */
    Public $modBC;

    /**
     * NF-e/NFC-e :N14 - pRedBC
     */
    Public $pRedBC;

    /**
     * NF-e/NFC-e :N15 - vBC
     */
    Public $vBC;
    Public $vBC_Desonerado;

    /**
     * NF-e/NFC-e :N16 - pICMS
     */
    Public $pICMS;
    Public $pICMS_Desonerado;

    /**
     * NF-e/NFC-e :N16a - vICMSOp
     */
    Public $vICMSOp;

    /**
     * NF-e/NFC-e :N16b - pDif
     */
    Public $pDif;

    /**
     * NF-e/NFC-e :N16c - vICMSDif
     */
    Public $vICMSDif;

    /**
     * NF-e/NFC-e :N17 - vICMS
     */
    Public $vICMS;
    Public $vICMS_Desonerado;

    /**
     * NF-e/NFC-e :N18 - modBCST
     */
    Public $modBCST;

    /**
     * NF-e/NFC-e :N19 - pMVAST
     */
    Public $pMVAST;

    /**
     * NF-e/NFC-e :N20 - pRedBCST
     */
    Public $pRedBCST;

    /**
     * NF-e/NFC-e :N21 - vBCST
     */
    Public $vBCST;
    Public $vBCST_NaoDestacado;

    /**
     * NF-e/NFC-e :N22 - pICMSST
     */
    Public $pICMSST;

    /**
     * NF-e/NFC-e :N23 - vICMSST
     */
    Public $vICMSST;
    Public $vICMSST_NaoDestacado;

    /**
     * NF-e/NFC-e :N24 - UFST
     */
    Public $UFST;

    /**
     * NF-e/NFC-e :N25 - pBCOp
     */
    Public $pBCOp;

    /**
     * NF-e/NFC-e :N26 - vBCSTRet
     */
    Public $vBCSTRet;

    /**
     * NF-e/NFC-e :N27 - vICMSSTRet
     */
    Public $vICMSSTRet;
    /**
     * NF-e/NFC-e :N27a - vICMSDeson
     */
    Public $vICMSDeson;

    /**
     * NF-e/NFC-e :N28 - motDesICMS
     */
    Public $motDesICMS;

    /**
     * NF-e/NFC-e :N29 - pCredSN
     */
    Public $pCredSN;

    /**
     * NF-e/NFC-e :N30 - vCredICMSSN
     */
    Public $vCredICMSSN;

    /**
     * NF-e/NFC-e :N31 - vBCSTDest
     */
    Public $vBCSTDest;

    /**
     * NF-e/NFC-e :N32 - vICMSSTDest
     */
    Public $vICMSSTDest;

}

