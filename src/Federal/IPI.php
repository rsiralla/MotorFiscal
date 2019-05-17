<?php

namespace MotorFiscal\Federal;

use MotorFiscal\Base;

/**
 * Classe com todas as informações para escrituração do IPI.
 */
class IPI extends Base
{
    /**
     * NF-e/NFC-e :O02 - clEnq.
     */
    public $clEnq;

    /**
     * NF-e/NFC-e :O03 - CNPJProd.
     */
    public $CNPJProd;

    /**
     * NF-e/NFC-e :O04 - cSelo.
     */
    public $cSelo;

    /**
     * NF-e/NFC-e :O05 - qSelo.
     */
    public $qSelo;

    /**
     * NF-e/NFC-e :O06 - cEnq.
     */
    public $cEnq;

    /**
     * NF-e/NFC-e :O09 - CST.
     */
    public $CST;

    /**
     * NF-e/NFC-e :O10 - vBC.
     */
    public $vBC;

    /**
     * NF-e/NFC-e :O11 - qUnid.
     */
    public $qUnid;

    /**
     * NF-e/NFC-e :O12 - vUnid.
     */
    public $vUnid;

    /**
     * NF-e/NFC-e :O13 - pIPI.
     */
    public $pIPI;

    /**
     * NF-e/NFC-e :O14 - vIPI.
     */
    public $vIPI;
}
