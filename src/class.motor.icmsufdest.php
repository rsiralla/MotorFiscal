<?php

namespace MotorFiscal;
require_once "class.motor.base.php";

class ICMSUFDest extends Base
{
        /**
         * NF-e/NFC-e :NA03 - vBCUFDest
         */

        Public $vBCUFDest;
        /**
         * NF-e/NFC-e :NA05 - pFCPUFDest
         */

        Public $pFCPUFDest;
        /**
         * NF-e/NFC-e :NA07 - pICMSUFDest
         */
        Public $pICMSUFDest;

        /**
         * NF-e/NFC-e :NA09 - pICMSInter
         */
        Public $pICMSInter;

        /**
         * NF-e/NFC-e :NA11 - pICMSInterPart
         */
        Public $pICMSInterPart;

        /**
         * NF-e/NFC-e :NA13 - vFCPUFDest
         */
        Public $vFCPUFDest;

        /**
         * NF-e/NFC-e :NA15 - vICMSUFDest
         */
        Public $vICMSUFDest;

        /**
         * NF-e/NFC-e :NA17 - vICMSUFRemet
         */
        Public $vICMSUFRemet;

}