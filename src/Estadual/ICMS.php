<?php

namespace MotorFiscal\Estadual;

use MotorFiscal\Base;

/**
 * Classe com todas as informações para escrituração do ICMS.
 */
class ICMS extends Base
{
    /**
     * NF-e/NFC-e :N11 - Orig.
     */
    public $orig;
    /**
     * NF-e/NFC-e :N12 - CST.
     */
    public $CST;
    /**
     * NF-e/NFC-e :N12a - CSOSN.
     */
    public $CSOSN;
    /**
     * NF-e/NFC-e :N13 - modBC.
     */
    public $modBC;
    /**
     * NF-e/NFC-e :N14 - pRedBC.
     */
    public $pRedBC;
    /**
     * NF-e/NFC-e :N15 - vBC.
     */
    public $vBC;
    public $vBC_Desonerado;
    /**
     * NF-e/NFC-e :N16 - pICMS.
     */
    public $pICMS;
    public $pICMS_Desonerado;
    /**
     * NF-e/NFC-e :N16a - vICMSOp.
     */
    public $vICMSOp;
    /**
     * NF-e/NFC-e :N16b - pDif.
     */
    public $pDif;
    /**
     * NF-e/NFC-e :N16c - vICMSDif.
     */
    public $vICMSDif;
    /**
     * NF-e/NFC-e :N17 - vICMS.
     */
    public $vICMS;
    public $vICMS_Desonerado;
    /**
     * NF-e/NFC-e :N18 - modBCST.
     */
    public $modBCST;
    /**
     * NF-e/NFC-e :N19 - pMVAST.
     */
    public $pMVAST;
    /**
     * NF-e/NFC-e :N20 - pRedBCST.
     */
    public $pRedBCST;
    /**
     * NF-e/NFC-e :N21 - vBCST.
     */
    public $vBCST;
    public $vBCST_NaoDestacado;
    /**
     * NF-e/NFC-e :N22 - pICMSST.
     */
    public $pICMSST;
    /**
     * NF-e/NFC-e :N23 - vICMSST.
     */
    public $vICMSST;
    public $vICMSST_NaoDestacado;
    /**
     * NF-e/NFC-e :N24 - UFST.
     */
    public $UFST;
    /**
     * NF-e/NFC-e :N25 - pBCOp.
     */
    public $pBCOp;
    /**
     * NF-e/NFC-e :N26 - vBCSTRet.
     */
    public $vBCSTRet;
    /**
     * NF-e/NFC-e :N27 - vICMSSTRet.
     */
    public $vICMSSTRet;
    /**
     * NF-e/NFC-e :N27a - vICMSDeson.
     */
    public $vICMSDeson;
    /**
     * NF-e/NFC-e :N28 - motDesICMS.
     */
    public $motDesICMS;
    /**
     * NF-e/NFC-e :N29 - pCredSN.
     */
    public $pCredSN;
    /**
     * NF-e/NFC-e :N30 - vCredICMSSN.
     */
    public $vCredICMSSN;
    /**
     * NF-e/NFC-e :N31 - vBCSTDest.
     */
    public $vBCSTDest;
    /**
     * NF-e/NFC-e :N32 - vICMSSTDest.
     */
    public $vICMSSTDest;
    protected $vICMS_Ficto = 0.0;

    /**
     * @return float
     */
    public function getVICMSFicto()
    {
        return $this->vICMS_Ficto;
    }

    /**
     * @param float $vICMS_Ficto
     */
    public function setVICMSFicto($vICMS_Ficto)
    {
        $this->vICMS_Ficto = $vICMS_Ficto;
    }
}
