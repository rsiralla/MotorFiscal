# Motor Fiscal PHP

[![Coverage Status](https://coveralls.io/repos/github/JonatasFischer/MotorFiscal/badge.svg?branch=master)](https://coveralls.io/github/JonatasFischer/MotorFiscal?branch=master)


O **Motor Fiscal** é um uma biblioteca com objetivo de facilitar o cálculo de impostos para *Nota Fiscal Eletrônica* (**NF-e**) Nota Fiscal a Consumidor Eletronica (**NFC-e**) e para a Nota Fiscal de Serviços Eletrônica (**NFS-e**). Toda a estrutura das classes é baseada no manual da NF-e.


Visto o **ICMS** ser **estadual** e o **ISS** ser **municipal** podem existir particularidades nos cálculos dos impostos para estados/municipios. 
Os chamados abertos (issues) serão atentidos tão logo quanto possível. Caso precise de suporte para implantar em seu sistema você contratar consultoria através do email jonatas.fischer@hotmail.com

## Utilização
Dento da pasta tests existem exemplos de diversos calculos de notas fiscais para empresas optantes pelo simples nacional e empresas RPA. Abaixo segue um breve exemplo de como utilizar a classe:
```php
<?php
...
use MotorFiscal\Destinatario;  
use MotorFiscal\DocumentoFiscal;  
use MotorFiscal\Emitente;  
use MotorFiscal\Operacao;  
use MotorFiscal\Produto;
...
//emitente
$emitente = new Emitente();  
$emitente->identificador = 1;  
$emitente->ContribuinteIPI = 0;  
$emitente->CRT = 3;  
$emitente->PercCreditoSimples = 0;
//destinatário
$destinatario = new Destinatario();  
$destinatario->identificador = 1;
//Operação
$operacao = new Operacao();  
$operacao->identificador = 1;  
$operacao->CFOPMercadoria = 5102;  
$operacao->CFOPMercadoriaST = 5102;  
$operacao->CFOPMercadoriaSTSubstituido = 5102;  
$operacao->CFOPProduto = 5409;  
$operacao->CFOPProdutoST = 5409;  
$operacao->TipoOperacao = 0;
$operacao->identificacao = 1;
$operacao->finalidade = 1;  
$operacao->indFinal = 0;  
$operacao->indPres = 0;  
$operacao->NaturezaOperacao = 'Venda a consumidor final';
//Documento Fiscal
$nf = new DocumentoFiscal($emitente, $destinatario, $operacao);
$nf->tipoParametroPesquisa = DocumentoFiscal::OBJETO;
//Configura a a função de pesquisa de informação sobre a tributação do ICMS
$nf->buscaTribFunctionICMS = function (Produto $produto,  
                                             Operacao $operacao,  
                                             Emitente $emitente,  
                                             Destinatario $destinatario) {  

	$config = new \stdClass();  
	$config->CSOSN = '101';  
	$config->CST = '00';  
	$config->IncluirIPIBaseICMS = 0;  
	$config->PercMVAProprio = 0;  
	$config->IncluirFreteBaseICMS = 1;  
	$config->PercRedICMS = 0;  
	$config->PercDiferimento = 0; //Percentual de diferimento do ICMS  
	$config->DestacarICMSDes = 0;  
	$config->MotivoDesICMS = 0;  
	$config->ValorBaseICMS = 100;  
	$config->DestacarICMS = 1;  
	$config->ModalidadeBaseICMS = 3;  
	$config->AliquotaICMS = 12;  
	$config->AliquotaICMSST = 17;  
	$config->ModalidadeBaseICMSST = 4;  
	$config->PercMVAAjustadoST = 100;  
	$config->PercDiferimento = 0;  
	$config->DestacarICMSST = 0;  
	$config->PercIcmsUFDest = 17;  
	$config->PercFCPUFDest = 0; 
	return $config;
};
$nf->buscaTribFunctionIPI = function ($produto, $operacao, $emitente, $destinatario) {  
	$config = new \stdClass();  
	$config->CST = '00';  
	$config->Aliquota = 10;  
	$config->clEnq = 999;  
	$config->CNPJProd = 999;  
	$config->cSelo = 999;  
	$config->qSelo = 999;  
	$config->cEnq = 999;
	return $config;
};  
  
$nf->buscaTribFunctionPIS = function ($produto, $operacao, $emitente, $destinatario) {  
	$config = new \stdClass();  
	$config->CST = '01';  
	$config->AliquotaPis = 1.65;  
	$config->qTrib = 0;  
	$config->ValorPIS = 0; 
	return $config;
};  
  
$nf->buscaTribFunctionCOFINS = function ($produto, $operacao, $emitente, $destinatario) {  
	$config = new \stdClass();  
	$config->CST = '01';  
	$config->AliquotaCofins = 7.6;  
	$config->qTrib = 0;  
	$config->ValorCOFINS = 0;  

	return $config; 
};  
//função para pesquisar as configurações de tributação para cada tipo de produto  
$nf->buscaTribFunctionIBPT = function ($produto, $operacao, $emitente, $destinatario) {  
  if($produto->tipoItem == 0)  
 {  
	 $ret = new \stdClass();  
	  $ret->PercTribFed = 10;  
	  $ret->PercTribEst = 10;  
	  $ret->PercTribMun = 0;  
  }  
  else  
  {  
	  $ret = new \stdClass();  
	  $ret->PercTribFed = 10;  
	  $ret->PercTribEst = 0;  
	  $ret->PercTribMun = 15;  
  }  
  return $ret;  
};  

$nf->buscaTribFunctionISSQN = function ($produto, $operacao, $emitente, $destinatario) {  
  $ret = new \stdClass();  
  $ret->Aliquota = 15;  
  //Retenção de ISS  
  $ret->ISSRetemPF = true;  
  $ret->ISSValorMinRetPF = 100;  
  $ret->ISSRetemPJ = true;  
  $ret->ISSValorMinRetPJ = 1000;  
  //Retenção de IR  
  $ret->IRRetem = true;  
  $ret->IRRetPerc = 1.5;  
  //retenção CSLL  
  $ret->CSLLRetem = true;  
  $ret->CSLLRetPerc = 1;  
  //retenção INSS  
  $ret->INSSRetem = true;  
  $ret->INSSRetPerc = 11;  
  //retenção COFINS/PIS  
  $ret->PISCOFINSRetem = true;  
  $ret->PISRetPerc = 0.65;  
  $ret->COFINSRetPerc = 3;  
  $ret->vMinRetImpFed = 10;  
 return $ret;  
};

$prod = new Produto();  
$prod->identificador = 2;  
$prod->TipoTributacaoIPI = 0;  
$prod->FormaAquisicao = 1; //Adiquirida de Terceiros  
$prod->vProd = 100;  
$prod->vDesc = 0;  
$prod->vFrete = 0;  
$prod->vOutro = 0;  
$prod->vSeg = 0;

$item = &$nf->addItem($prod);
$nf->totalizarDocumento();

```
**Para maiores exemplos favor verificar a pasta de testes**

