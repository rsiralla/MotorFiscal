<?php

namespace MotorFiscal;

require_once "class.motor.base.php";

/**
 * Classe com todas as informações para escrituração do ISSQN
 */
class ISSQN extends Base
{
    /**
     * NF-e/NFC-e : U01 - ISSQN
     */
    Public $ISSQN;
    /**
     * NF-e/NFC-e : U02 - vBC
     */
    Public $vBC;
    /**
     * NF-e/NFC-e : U03 - vAliq
     */
    Public $vAliq;
    /**
     * NF-e/NFC-e : U04 - vISSQN
     */
    Public $vISSQN;
    /**
     * NF-e/NFC-e : U05 - cMunFG
     */
    Public $cMunFG;
    /**
     * NF-e/NFC-e : U06 - cListServ
     */
    Public $cListServ;
    /**
     * NF-e/NFC-e : U07 - vDeducao
     */
    Public $vDeducao;
    /**
     * NF-e/NFC-e : U08 - vOutro
     */
    Public $vOutro = 0;
    /**
     * NF-e/NFC-e : U09 - vDescIncond
     */
    Public $vDescIncond;
    /**
     * NF-e/NFC-e : U10 - vDescCond
     */
    Public $vDescCond;
    Public $vISSRet;
    /**
     * NF-e/NFC-e : U12 - indISS
     */
    Public $indISS;
    /**
     * NF-e/NFC-e : U13 - cServico
     */
    Public $cServico;
    /**
     * NF-e/NFC-e : U14 - cMun
     */
    Public $cMun;
    /**
     * NF-e/NFC-e : U15 - cPais
     */
    Public $cPais;
    /*
     * NF-e/NFC-e : U11 - vISSRet 
     */
    /**
     * NF-e/NFC-e : U16 - nProcesso
     */
    Public $nProcesso;
    /**
     * NF-e/NFC-e : U17 - indIncentivo
     */
    Public $indIncentivo;
    protected $vRetPIS = 0;
    protected $vRetCOFINS = 0;
    protected $vRetIR = 0;
    protected $vRetCSLL = 0;
    protected $vRetINSS = 0;

}
