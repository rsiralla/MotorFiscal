<?php

namespace MotorFiscal;
/**
 * Classe com todas as informações do destinatário
 */
class Destinatario extends Base
{
    /**
     * NF-e/NFC-e :E02 - CNPJ
     */
    Public $CNPJ;
    /**
     * NF-e/NFC-e :E03 - CPF
     */
    Public $CPF;
    /**
     * NF-e/NFC-e :E03a - idEstrangeiro
     */
    Public $idEstrangeiro;
    /**
     * NF-e/NFC-e :E04 - xNome
     */
    Public $xNome;
    /**
     * NF-e/NFC-e :E06 - Logradouro
     */
    Public $xLgr;
    /**
     * NF-e/NFC-e :E07 - Número
     */
    Public $nro;//Variável auxiliar
    /**
     * NF-e/NFC-e :E08 - Complemento
     */
    Public $xCpl;
    /**
     * NF-e/NFC-e :E09 - Bairro
     */
    Public $xBairro;
    /**
     * NF-e/NFC-e :E10 - Código do municípioMun
     */
    Public $cMun;
    /**
     * NF-e/NFC-e :E11 - Nome do município
     */
    Public $xMun;
    /**
     * NF-e/NFC-e :E12 - Sigla da UF
     */
    Public $UF;
    /**
     * NF-e/NFC-e :E13 - Código do CEP
     */
    Public $CEP;
    /**
     * NF-e/NFC-e :E14 - Código do País
     */
    Public $cPais;
    /**
     * NF-e/NFC-e :E15 - Nome do País
     */
    Public $xPais;
    /**
     * NF-e/NFC-e :E16 - Telefone
     */
    Public $fone;
    /**
     * NF-e/NFC-e :E16a - indIEDest
     */
    Public $indIEDest;
    /**
     * NF-e/NFC-e :E17 - IE
     */
    Public $IE;
    /**
     * NF-e/NFC-e :E18 - IEST
     */
    Public $IEST;
    /**
     * NF-e/NFC-e :E18a - IM
     */
    Public $IM;
    /**
     * NF-e/NFC-e :E19 - email
     */
    Public $email;
    protected $identificador;
    protected $xFant;

}