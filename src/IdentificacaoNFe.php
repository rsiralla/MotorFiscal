<?php

namespace MotorFiscal;

class IdentificacaoNFe extends Base
{
	
	/**
	 * NF-e/NFC-e :B02 - cUF - Cуdigo da UF do emitente do Documento Fiscal
	 */
	public $cUF;
	
	/**
	 * NF-e/NFC-e :B03 - cNF - Cуdigo Numйrico que compхe a Chave de Acesso
	 */
	public $cNF;
	
	/**
	 * NF-e/NFC-e :B04 - natOp - Descriзгo da Natureza da Operaзгo
	 */
	public $natOp;
	
	/**
	 * NF-e/NFC-e :B05 - indPag - Indicador da forma de pagamento
	 */
	public $indPag;
	
	/**
	 * NF-e/NFC-e :B06 - mod - Cуdigo do Modelo do Documento Fiscal
	 */
	public $mod;
	
	/**
	 * NF-e/NFC-e :B07 - serie - Sйrie do Documento Fiscal
	 */
	public $serie;
	
	/**
	 * NF-e/NFC-e :B08 - nNF - Nъmero do Documento Fiscal
	 */
	public $nNF;
	
	/**
	 * NF-e/NFC-e :B09 - dhEmi - Data e hora de emissгo do Documento Fiscal
	 */
	public $dhEmi;
	
	/**
	 * NF-e/NFC-e :B10 - dhSaiEnt - Data e hora de Saнda ou da Entrada da Mercadoria/Produto
	 */
	public $dhSaiEnt;
	
	/**
	 * NF-e/NFC-e :B11 - tpNF - Tipo de Operaзгo
	 */
	public $tpNF;
	
	/**
	 * NF-e/NFC-e :B11a - idDest - Identificador de local de destino da operaзгo
	 */
	public $idDest;
	
	/**
	 * NF-e/NFC-e :B12 - cMunFG - Cуdigo do Municнpio de Ocorrкncia do Fato Gerador
	 */
	public $cMunFG;
	
	/**
	 * NF-e/NFC-e :B21 - tpImp - Formato de Impressгo do DANFE
	 */
	public $tpImp;
	
	/**
	 * NF-e/NFC-e :B22 - tpEmis - Tipo de Emissгo da NF-e
	 */
	public $tpEmis;
	
	/**
	 * NF-e/NFC-e :B23 - cDV - Dнgito Verificador da Chave de Acesso da NF-e
	 */
	public $cDV;
	
	/**
	 * NF-e/NFC-e :B24 - tpAmb - Identificaзгo do Ambiente
	 */
	public $tpAmb;
	
	/**
	 * NF-e/NFC-e :B25 - finNFe - Finalidade de emissгo da NF-e
	 */
	public $finNFe;
	
	/**
	 * NF-e/NFC-e :B25a - indFinal - Indica operaзгo com Consumidor final
	 */
	public $indFinal;
	
	/**
	 * NF-e/NFC-e :B25b - indPres - Indicador de presenзa do comprador no estabelecimento comercial no momento da
	 * operaзгo
	 */
	public $indPres;
	
	/**
	 * NF-e/NFC-e :B26 - procEmi - Processo de emissгo da NF-e
	 */
	public $procEmi;
	
}
