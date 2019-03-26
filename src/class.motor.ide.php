<?php

namespace MotorFiscal;

require_once "class.motor.base.php";

class IdentificacaoNFe extends Base
{

    /**
     * NF-e/NFC-e :B02 - cUF - Código da UF do emitente do Documento Fiscal
     */
    Public $cUF;

    /**
     * NF-e/NFC-e :B03 - cNF - Código Numérico que compõe a Chave de Acesso
     */
    Public $cNF;

    /**
     * NF-e/NFC-e :B04 - natOp - Descrição da Natureza da Operação
     */
    Public $natOp;

    /**
     * NF-e/NFC-e :B05 - indPag - Indicador da forma de pagamento
     */
    Public $indPag;

    /**
     * NF-e/NFC-e :B06 - mod - Código do Modelo do Documento Fiscal
     */
    Public $mod;

    /**
     * NF-e/NFC-e :B07 - serie - Série do Documento Fiscal
     */
    Public $serie;

    /**
     * NF-e/NFC-e :B08 - nNF - Número do Documento Fiscal
     */
    Public $nNF;

    /**
     * NF-e/NFC-e :B09 - dhEmi - Data e hora de emissão do Documento Fiscal
     */
    Public $dhEmi;

    /**
     * NF-e/NFC-e :B10 - dhSaiEnt - Data e hora de Saída ou da Entrada da Mercadoria/Produto
     */
    Public $dhSaiEnt;

    /**
     * NF-e/NFC-e :B11 - tpNF - Tipo de Operação
     */
    Public $tpNF;

    /**
     * NF-e/NFC-e :B11a - idDest - Identificador de local de destino da operação
     */
    Public $idDest;

    /**
     * NF-e/NFC-e :B12 - cMunFG - Código do Município de Ocorrência do Fato Gerador
     */
    Public $cMunFG;

    /**
     * NF-e/NFC-e :B21 - tpImp - Formato de Impressão do DANFE
     */
    Public $tpImp;

    /**
     * NF-e/NFC-e :B22 - tpEmis - Tipo de Emissão da NF-e
     */
    Public $tpEmis;

    /**
     * NF-e/NFC-e :B23 - cDV - Dígito Verificador da Chave de Acesso da NF-e
     */
    Public $cDV;

    /**
     * NF-e/NFC-e :B24 - tpAmb - Identificação do Ambiente
     */
    Public $tpAmb;

    /**
     * NF-e/NFC-e :B25 - finNFe - Finalidade de emissão da NF-e
     */
    Public $finNFe;

    /**
     * NF-e/NFC-e :B25a - indFinal - Indica operação com Consumidor final
     */
    Public $indFinal;

    /**
     * NF-e/NFC-e :B25b - indPres - Indicador de presença do comprador no estabelecimento comercial no momento da operação
     */
    Public $indPres;

    /**
     * NF-e/NFC-e :B26 - procEmi - Processo de emissão da NF-e
     */
    Public $procEmi;

}
