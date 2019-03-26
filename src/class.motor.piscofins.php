<?php
Namespace MotorFiscal;
require_once "class.motor.base.php";

class PIS extends Base
{

    /**
     * NF-e/NFC-e :Q06 - CST
     */
    Public $CST;


    /**
     * NF-e/NFC-e :Q07 - vBC
     */
    Public $vBC;
    Private $_vBC;


    /**
     * NF-e/NFC-e :Q08 - pPIS
     */
    Public $pPIS;


    /**
     * NF-e/NFC-e :Q09 - vPIS
     */
    Public $vPIS;


    /**
     * NF-e/NFC-e :Q10 - qBCProd
     */
    Public $qBCProd;


    /**
     * NF-e/NFC-e :Q11 - vAliqProd
     */
    Public $vAliqProd;
}


class COFINS extends Base
{

    /**
     * NF-e/NFC-e :S06 - CST
     */
    Public $CST;


    /**
     * NF-e/NFC-e :S07 - vBC
     */
    Public $vBC;


    /**
     * NF-e/NFC-e :S08 - pCOFINS
     */
    Public $pCOFINS;


    /**
     * NF-e/NFC-e :Q09 - qBCProd
     */
    Public $qBCProd;


    /**
     * NF-e/NFC-e :S10 - vAliqProd
     */
    Public $vAliqProd;


    /**
     * NF-e/NFC-e :S11 - vCOFINS
     */
    Public $vCOFINS;
}
