<?php

namespace MotorFiscal;

require_once "class.motor.base.php";

class IdentificacaoNFe extends Base
{

    /**
     * NF-e/NFC-e :B02 - cUF - Cуdigo da UF do emitente do Documento Fiscal
     */
    Public $cUF;

    /**
     * NF-e/NFC-e :B03 - cNF - Cуdigo Numйrico que compхe a Chave de Acesso
     */
    Public $cNF;

    /**
     * NF-e/NFC-e :B04 - natOp - Descriзгo da Natureza da Operaзгo
     */
    Public $natOp;

    /**
     * NF-e/NFC-e :B05 - indPag - Indicador da forma de pagamento
     */
    Public $indPag;

    /**
     * NF-e/NFC-e :B06 - mod - Cуdigo do Modelo do Documento Fiscal
     */
    Public $mod;

    /**
     * NF-e/NFC-e :B07 - serie - Sйrie do Documento Fiscal
     */
    Public $serie;

    /**
     * NF-e/NFC-e :B08 - nNF - Nъmero do Documento Fiscal
     */
    Public $nNF;

    /**
     * NF-e/NFC-e :B09 - dhEmi - Data e hora de emissгo do Documento Fiscal
     */
    Public $dhEmi;

    /**
     * NF-e/NFC-e :B10 - dhSaiEnt - Data e hora de Saнda ou da Entrada da Mercadoria/Produto
     */
    Public $dhSaiEnt;

    /**
     * NF-e/NFC-e :B11 - tpNF - Tipo de Operaзгo
     */
    Public $tpNF;

    /**
     * NF-e/NFC-e :B11a - idDest - Identificador de local de destino da operaзгo
     */
    Public $idDest;

    /**
     * NF-e/NFC-e :B12 - cMunFG - Cуdigo do Municнpio de Ocorrкncia do Fato Gerador
     */
    Public $cMunFG;

    /**
     * NF-e/NFC-e :B21 - tpImp - Formato de Impressгo do DANFE
     */
    Public $tpImp;

    /**
     * NF-e/NFC-e :B22 - tpEmis - Tipo de Emissгo da NF-e
     */
    Public $tpEmis;

    /**
     * NF-e/NFC-e :B23 - cDV - Dнgito Verificador da Chave de Acesso da NF-e
     */
    Public $cDV;

    /**
     * NF-e/NFC-e :B24 - tpAmb - Identificaзгo do Ambiente
     */
    Public $tpAmb;

    /**
     * NF-e/NFC-e :B25 - finNFe - Finalidade de emissгo da NF-e
     */
    Public $finNFe;

    /**
     * NF-e/NFC-e :B25a - indFinal - Indica operaзгo com Consumidor final
     */
    Public $indFinal;

    /**
     * NF-e/NFC-e :B25b - indPres - Indicador de presenзa do comprador no estabelecimento comercial no momento da operaзгo
     */
    Public $indPres;

    /**
     * NF-e/NFC-e :B26 - procEmi - Processo de emissгo da NF-e
     */
    Public $procEmi;

}
