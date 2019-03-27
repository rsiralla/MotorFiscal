<?php

namespace MotorFiscal;

class IdentificacaoNFe extends Base
{
	
	/**
	 * NF-e/NFC-e :B02 - cUF - Código da UF do emitente do Documento Fiscal
	 */
	public $cUF;
	
	/**
	 * NF-e/NFC-e :B03 - cNF - Código Numérico que compõe a Chave de Acesso
	 */
	public $cNF;
	
	/**
	 * NF-e/NFC-e :B04 - natOp - Descrição da Natureza da Operação
	 */
	public $natOp;
	
	/**
	 * NF-e/NFC-e :B05 - indPag - Indicador da forma de pagamento
	 */
	public $indPag;
	
	/**
	 * NF-e/NFC-e :B06 - mod - Código do Modelo do Documento Fiscal
	 */
	public $mod;
	
	/**
	 * NF-e/NFC-e :B07 - serie - Série do Documento Fiscal
	 */
	public $serie;
	
	/**
	 * NF-e/NFC-e :B08 - nNF - Número do Documento Fiscal
	 */
	public $nNF;
	
	/**
	 * NF-e/NFC-e :B09 - dhEmi - Data e hora de emissão do Documento Fiscal
	 */
	public $dhEmi;
	
	/**
	 * NF-e/NFC-e :B10 - dhSaiEnt - Data e hora de Saída ou da Entrada da Mercadoria/Produto
	 */
	public $dhSaiEnt;
	
	/**
	 * NF-e/NFC-e :B11 - tpNF - Tipo de Operação
	 */
	public $tpNF;
	
	/**
	 * NF-e/NFC-e :B11a - idDest - Identificador de local de destino da operação
	 */
	public $idDest;
	
	/**
	 * NF-e/NFC-e :B12 - cMunFG - Código do Município de Ocorrência do Fato Gerador
	 */
	public $cMunFG;
	
	/**
	 * NF-e/NFC-e :B21 - tpImp - Formato de Impressão do DANFE
	 */
	public $tpImp;
	
	/**
	 * NF-e/NFC-e :B22 - tpEmis - Tipo de Emissão da NF-e
	 */
	public $tpEmis;
	
	/**
	 * NF-e/NFC-e :B23 - cDV - Dígito Verificador da Chave de Acesso da NF-e
	 */
	public $cDV;
	
	/**
	 * NF-e/NFC-e :B24 - tpAmb - Identificação do Ambiente
	 */
	public $tpAmb;
	
	/**
	 * NF-e/NFC-e :B25 - finNFe - Finalidade de emissão da NF-e
	 */
	public $finNFe;
	
	/**
	 * NF-e/NFC-e :B25a - indFinal - Indica operação com Consumidor final
	 */
	public $indFinal;
	
	/**
	 * NF-e/NFC-e :B25b - indPres - Indicador de presença do comprador no estabelecimento comercial no momento da
	 * operação
	 */
	public $indPres;
	
	/**
	 * NF-e/NFC-e :B26 - procEmi - Processo de emissão da NF-e
	 */
	public $procEmi;
	
}
