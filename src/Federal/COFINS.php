<?php
/**
 * Created by PhpStorm.
 * User: j.fischer
 * Date: 27.03.19
 * Time: 13:13.
 */

namespace MotorFiscal\Federal;

use MotorFiscal\Base;

class COFINS extends Base
{
    /**
     * NF-e/NFC-e :S06 - CST.
     */
    public $CST;

    /**
     * NF-e/NFC-e :S07 - vBC.
     */
    public $vBC;

    /**
     * NF-e/NFC-e :S08 - pCOFINS.
     */
    public $pCOFINS;

    /**
     * NF-e/NFC-e :Q09 - qBCProd.
     */
    public $qBCProd;

    /**
     * NF-e/NFC-e :S10 - vAliqProd.
     */
    public $vAliqProd;

    /**
     * NF-e/NFC-e :S11 - vCOFINS.
     */
    public $vCOFINS;
}
