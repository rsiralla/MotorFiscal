<?php

namespace MotorFiscal;
require_once "class.motor.base.php";

class IPI extends Base
{

    /**
     * NF-e/NFC-e :O02 - clEnq
     */
    Public $clEnq;


    /**
     * NF-e/NFC-e :O03 - CNPJProd
     */
    Public $CNPJProd;


    /**
     * NF-e/NFC-e :O04 - cSelo
     */
    Public $cSelo;


    /**
     * NF-e/NFC-e :O05 - qSelo
     */
    Public $qSelo;


    /**
     * NF-e/NFC-e :O06 - cEnq
     */
    Public $cEnq;


    /**
     * NF-e/NFC-e :O09 - CST
     */
    Public $CST;


    /**
     * NF-e/NFC-e :O10 - vBC
     */
    Public $vBC;


    /**
     * NF-e/NFC-e :O11 - qUnid
     */
    Public $qUnid;


    /**
     * NF-e/NFC-e :O12 - vUnid
     */
    Public $vUnid;


    /**
     * NF-e/NFC-e :O13 - pIPI
     */
    Public $pIPI;


    /**
     * NF-e/NFC-e :O14 - vIPI
     */
    Public $vIPI;
}
