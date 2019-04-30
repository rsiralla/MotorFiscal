<?php
/**
 * Created by PhpStorm.
 * User: j.fischer
 * Date: 27.03.19
 * Time: 14:58
 */

class Trib
{
	
	static function IPI($prod, $oper, $emit, $dest)
	{
		$ipitrib             = array();
		$config              = new \stdClass();
		$config->CST         = '00';
		$config->Aliquota    = 10;
		$config->clEnq       = 999;
		$config->CNPJProd    = 999;
		$config->cSelo       = 999;
		$config->qSelo       = 999;
		$config->cEnq        = 999;
		$ipitrib[1][1][1][1] = $config;
		$config2             = clone $config;
		$config2->CST        = '51';
		$config2->Aliquota   = 0;
		$ipitrib[1][1][1][2] = $config2;
		
		return $ipitrib[$emit][$dest][$oper][$prod];
	}
	
	
	static function PIS($prod, $oper, $emit, $dest)
	{
		$config              = new \stdClass();
		$config->CST         = '01';
		$config->AliquotaPis = 1.65;
		$config->qTrib       = 0;
		$config->ValorPIS    = 0;
		
		return $config;
	}
	
	
	static function COFINS($prod, $oper, $emit, $dest)
	{
		$config                 = new \stdClass();
		$config->CST            = '01';
		$config->AliquotaCofins = 7.6;
		$config->qTrib          = 0;
		$config->ValorCOFINS    = 0;
		
		return $config;
	}
	
	
	static function ICMS($prod, $oper, $emit, $dest)
	{
		$icmstrib = array();
		/* Tributação 1 - CSOSN 101 com IPI e ICMS ST Não Destacado */
		$config                       = new \stdClass();
		$config->CSOSN                = '101';
		$config->CST                  = '00';
		$config->IncluirIPIBaseICMS   = 0;
		$config->PercMVAProprio       = 0;
		$config->IncluirFreteBaseICMS = 1;
		$config->PercRedICMS          = 0;
		$config->PercDiferimento      = 0; //Percentual de diferimento do ICMS
		$config->DestacarICMSDes      = 0;
		$config->MotivoDesICMS        = 0;
		$config->ValorBaseICMS        = 100;
		$config->DestacarICMS         = 1;
		$config->ModalidadeBaseICMS   = 3;
		$config->AliquotaICMS         = 12;
		$config->AliquotaICMSST       = 17;
		$config->ModalidadeBaseICMSST = 4;
		$config->PercMVAAjustadoST    = 100;
		$config->PercDiferimento      = 0;
		$config->DestacarICMSST       = 0;
		$config->PercIcmsUFDest       = 17;
		$config->PercFCPUFDest        = 0;
		$icmstrib[1][1][1][1]         = $config;
		$config2                      = clone $config;
		
		$config2->DestacarICMSST = 1;
		$config2->CSOSN          = '201';
		$config2->CST            = '10';
		$icmstrib[1][1][1][2]    = $config2;

		$config2->DestacarICMSST = 0;

		$config3                  = clone $config;
		$config3->PercRedICMS     = 50;
		$config3->CSOSN           = '900';
		$icmstrib[1][1][1][3]    = $config2;
		
		return $icmstrib[$emit][$dest][$oper][$prod];
	}
	
}