<?php

namespace MotorFiscal;

/* Adicionado ao cadastro de produtos
  vUnidTribIPI
 */

use MotorFiscal\Estadual\ICMS;
use MotorFiscal\Estadual\ICMSTot;
use MotorFiscal\Estadual\ICMSUFDest;
use MotorFiscal\Federal\COFINS;
use MotorFiscal\Federal\IPI;
use MotorFiscal\Federal\PIS;
use MotorFiscal\Federal\RetTrib;
use MotorFiscal\Municipal\ISSQN;

class DocumentoFiscal extends Base
{
	
	/**
	 * @var \MotorFiscal\Estadual\ICMSTot
	 */
	public $ICMSTot;
	/**
	 * @var \MotorFiscal\Municipal\ISSQN
	 */
	public $ISSQNtot;
	/**
	 * @var \MotorFiscal\Federal\RetTrib
	 */
	public $retTrib;
	/**
	 * @var \MotorFiscal\Emitente
	 */
	public $emit;
	/**
	 * @var \MotorFiscal\Destinatario
	 */
	public $dest;
	/**
	 * @var \MotorFiscal\IdentificacaoNFe
	 */
	public $ide;
	public $itens = null;
	public $buscaTribFunction;
	public $buscaTribFunctionIBPT;
	public $buscaTribFunctionIPI;
	
	
	/*
	  Função para calcular a tributação do produto
	 */
	public $buscaTribFunctionICMS;
	public $buscaTribFunctionPIS;
	public $buscaTribFunctionCOFINS;
	public $buscaTribFunctionISSQN;
	/**
	 * @var \MotorFiscal\Operacao
	 */
	protected $operacao;
	private   $objetoParametroPesquisa = false;
	
	
	public function __construct(Emitente $emitente,
	                            Destinatario $destinatario,
	                            Operacao $operacao,
	                            $objetoParametroPesquisa = false)
	{
		$this->emit                    = $emitente;
		$this->dest                    = $destinatario;
		$this->operacao                = $operacao;
		$this->ide                     = new IdentificacaoNFe();
		$this->ide->tpNF               = $operacao->TipoOperacao;
		$this->ide->idDest             = $operacao->identificacao;
		$this->ide->finNFe             = $operacao->finalidade;
		$this->ide->indFinal           = $operacao->indFinal;
		$this->ide->indPres            = $operacao->indPres;
		$this->ide->natOp              = $operacao->NaturezaOperacao;
		$this->objetoParametroPesquisa = $objetoParametroPesquisa;
	}
	
	
	public function &addItem(Produto $produto, Operacao $operacao = null)
	{
		/* Algumas validacoes */
		if(empty($this->emit))
		{
			throw new \Exception('Informe o Emitente da nota fiscal antes de adicionar um produto');
		}
		if($this->emit->ContribuinteIPI === null)
		{
			throw new \Exception('Informe se o Emitente é contribuinte do IPI');
		}
		
		if(empty($this->dest))
		{
			throw new \Exception('Informe o Destinatário da nota fiscal antes de adicionar um produto');
		}
		if(empty($this->operacao))
		{
			throw new \Exception('Informe a Operacao da nota fiscal antes de adicionar um produto');
		}
		
		/* se não informar uma operação específica ao adicionar um item usar a operação da nota */
		if(empty($operacao))
		{
			$operacao = $this->operacao;
		}
		if($produto->tipoItem === 1)
		{
			if($produto->cMunFG === '')
			{
				throw new \Exception("Deve ser informado o código do município do fato gerador do ISS na classe MotorFiscal\Produto para itens de serviço. Atual \"{$produto->cMunFG}\"");
			}
			
			if($produto->cMun === '')
			{
				throw new \Exception('Deve ser informado o código do município da incidência do ISS na classe MotorFiscal\Produto para itens de serviço');
			}
			
			if($produto->cListServ === '')
			{
				throw new \Exception('Deve ser informado o código do serviço (ABRASF) do ISS na classe MotorFiscal\Produto para itens de serviço');
			}
			
			if($produto->cServico === '')
			{
				throw new \Exception('Deve ser informado o código do serviço(Município) do ISS na classe MotorFiscal\Produto para itens de serviço');
			}
			
			if($produto->cPais === '' && $produto->cMunFG == 9999999)
			{
				throw new \Exception('Deve ser informado o código do pais para serviços internacionais na classe MotorFiscal\Produto para itens de serviço');
			}
			
			if($produto->indISS === '')
			{
				throw new \Exception('Deve ser informado a exigibilidade do ISS (1 = Sim, 2 = Não) MotorFiscal\Produto para itens de serviço');
			}
			
			if($produto->indISS == 2 && $produto->nProcesso === '')
			{
				throw new \Exception('Deve ser informado número do processo de inexigibilidade do ISSQN na classe MotorFiscal\Produto para itens de serviço');
			}
			
			if($produto->indIncentivo === '')
			{
				throw new \Exception('Deve ser informado a existência de incentivo fiscal(1=Sim, 2=Não) na classe MotorFiscal\Produto para itens de serviço');
			}
		}
		
		$item           = new ItemFiscal();
		$item->Operacao = $operacao;
		$item->prod     = $produto;
		$item->imposto  = new Imposto();
		if($produto->tipoItem === 0)
		{
			$item->imposto->ICMS = new ICMS();
			
			//se o emitente é contribuinte do IPI
			if($this->emit->ContribuinteIPI)
			{
				$item->imposto->IPI = new IPI();
			}
		}
		else
		{
			$item->imposto->ISSQN = new ISSQN();
		}
		
		$item->imposto->PIS    = new PIS();
		$item->imposto->COFINS = new COFINS();
		
		/* ================= Calcula Percentual Tributacao ============================== */
		if(isset($this->buscaTribFunctionIBPT))
		{
			$buscaTribFunctionIBPT = $this->buscaTribFunctionIBPT;
			if(!$this->objetoParametroPesquisa)
			{
				$tabelaIBPT = $buscaTribFunctionIBPT($produto->identificador, $this->emit->identificador,
				                                     $this->dest->identificador);
			}
			else
			{
				$tabelaIBPT = $buscaTribFunctionIBPT($produto, $this->emit, $this->dest);
			}
			$item->imposto->vTotTribFederal   = number_format(($produto->vProd - $produto->vDesc)
			                                                  * $tabelaIBPT->PercTribFed / 100, 2, '.', '');
			$item->imposto->vTotTribEstadual  = number_format(($produto->vProd - $produto->vDesc)
			                                                  * $tabelaIBPT->PercTribEst / 100, 2, '.', '');
			$item->imposto->vTotTribMunicipal = number_format(($produto->vProd - $produto->vDesc)
			                                                  * $tabelaIBPT->PercTribMun / 100, 2, '.', '');
			/* M02 */
			$item->imposto->vTotTrib = number_format($item->imposto->vTotTribFederal + $item->imposto->vTotTribEstadual
			                                         + $item->imposto->vTotTribMunicipal, 2, '.', '');
		}
		
		if($produto->tipoItem === 0)
		{
			
			/* ================= Calcula Tributação do IPI ============================== */
			if(isset($this->buscaTribFunctionIPI) && $this->emit->ContribuinteIPI)
			{
				$buscaTribFunctionIPI = $this->buscaTribFunctionIPI;
				if(!$this->objetoParametroPesquisa)
				{
					$tributacaoIPI = $buscaTribFunctionIPI($produto->identificador, $operacao->identificador,
					                                       $this->emit->identificador, $this->dest->identificador);
				}
				else
				{
					$tributacaoIPI = $buscaTribFunctionIPI($produto, $operacao, $this->emit, $this->dest);
				}
				
				$item->imposto->IPI->assign($tributacaoIPI);
				$item->imposto->IPI->CST      = $tributacaoIPI->CST;
				$item->imposto->IPI->clEnq    = $tributacaoIPI->clEnq;
				$item->imposto->IPI->CNPJProd = $tributacaoIPI->CNPJProd;
				$item->imposto->IPI->cSelo    = $tributacaoIPI->cSelo;
				$item->imposto->IPI->qSelo    = $tributacaoIPI->qSelo;
				$item->imposto->IPI->cEnq     = $tributacaoIPI->cEnq;
				switch($item->imposto->IPI->CST)
				{
					case '00':
					case '49':
					case '50':
					case '99':
						if($produto->TipoTributacaoIPI == 0)
						{/* Tributado por aliquota */
							/* O10 */
							$item->imposto->IPI->vBC = $produto->vProd - $produto->vDesc;
							/* O13 */
							$item->imposto->IPI->pIPI = $tributacaoIPI->Aliquota;
							/* O14 */
							$item->imposto->IPI->vIPI = round($item->imposto->IPI->vBC * $item->imposto->IPI->pIPI
							                                  / 100, 2);
						}
						else
						{ /* Tributado por quantidade */
							/* O11 */
							$item->imposto->IPI->qUnid = $produto->qTrib;
							/* O12 */
							$item->imposto->IPI->vUnid = $tributacaoIPI->vUnidTribIPI;
							/* O14 */
							$item->imposto->IPI->vIPI = $item->imposto->IPI->qUnid * $item->imposto->IPI->vUnid;
						}
						break;
				}
			}
			
			/* ============================= Calculo da Tributacao do ICMS =================== */
			
			//se for operação interestadual para consumidor final e o emitente não for simples nacional
			/*****************************************************************
			 * Conforme  liminar concedida pelo ministro Dias Toffoli        *
			 * em 17/02/2016 empresas do simples nacional                    *
			 * não estão obrigadas a realizar a partilha do ICMS             *
			 * mas deverão preencher todos os campos na nota fiscal          *
			 */
			if($this->emit->UF != $this->dest->UF//interestadual
			   && $this->ide->indFinal == 1)
			{//não é consumidor final
				$item->imposto->ICMSUFDest = new ICMSUFDest();
				
				//Se não foi informado o ICMS para a UF de destino deve subir uma exceção
				if(!isset($tributacaoICMS->PercIcmsUFDest))
				{
					throw new \Exception('Deve ser informada a alíquota de ICMS interestadual para operações com partilha de ICMS');
				}
			}
			
			$buscaTribFunctionICMS = $this->buscaTribFunctionICMS;
			
			/* pode pesquisar a tributação do produto passando dados como parametros ou os objetos*/
			if($this->objetoParametroPesquisa)
			{
				$tributacaoICMS = $buscaTribFunctionICMS($produto, $operacao, $this->emit, $this->dest);
			}
			else
			{
				$tributacaoICMS = $buscaTribFunctionICMS($produto->identificador, $operacao->identificador,
				                                         $this->emit->identificador, $this->dest->identificador);
			}
			
			$item->imposto->ICMS->assign($tributacaoICMS);
			
			if($produto->FormaAquisicao == 1)
			{
				/* I08 */
				$item->prod->CFOP = $operacao->CFOPMercadoria;
			}
			else
			{
				/* I08 */
				$item->prod->CFOP = $operacao->CFOPProduto;
			}
			
			/* N11 */
			$item->imposto->ICMS->orig = $produto->OrigemMercadoria;
			if($this->emit->CRT == 1)
			{/* Simples Nacional */
				/* N12a */
				$item->imposto->ICMS->CSOSN = $tributacaoICMS->CSOSN;
				/* Base/valor ficto do ICMS para fins de substituição tributária */
				$vBC_ICMS_FICTO = $produto->vProd - $produto->vDesc + $produto->vFrete + $produto->vOutro
				                  + $produto->vSeg;
				
				$item->imposto->ICMS->vICMS_Ficto = round($vBC_ICMS_FICTO * $tributacaoICMS->AliquotaICMS / 100, 2);
				
				$CST_ST = $item->imposto->ICMS->CSOSN;
				/* Calcula valor de crédito do ICMS */
				$vBC_ICMS_CredSN = $produto->vProd - $produto->vDesc + $produto->vSeg + $produto->vOutro;
				
				if($tributacaoICMS->IncluirIPIBaseICMS && $this->emit->ContribuinteIPI)
				{
					$vBC_ICMS_CredSN += is_numeric($item->imposto->IPI->vIPI) ? $item->imposto->IPI->vIPI : 0;
				}
				
				if($tributacaoICMS->IncluirFreteBaseICMS && is_numeric($produto->vFrete))
				{
					$vBC_ICMS_CredSN += $produto->vFrete;
				}
				
				switch($item->imposto->ICMS->CSOSN)
				{
					case '101':
					case '201':
						if($this->emit->PercCreditoSimples)
						{
							/* N29 */
							$item->imposto->ICMS->pCredSN = $this->emit->PercCreditoSimples;
							/* N30 */
							$item->imposto->ICMS->vCredICMSSN = ceil(round($item->imposto->ICMS->pCredSN
							                                               * $vBC_ICMS_CredSN / 100, 2) * 100) / 100;
						}
						break;
					case '900':
						if($operacao->isDevolucao($item->prod->CFOP))
						{
							$item = $this->calcularTributacaoIntegral($item, $tributacaoICMS, $produto);
						}
						else
						{
							if($this->emit->PercCreditoSimples > 0 && $tributacaoICMS->DestacarICMS == 1)
							{
								/* N29 */
								$item->imposto->ICMS->pCredSN = $this->emit->PercCreditoSimples;
								//TODO: Adicionar Frete e outras despesas neste calculo
								/* N30 */
								$item->imposto->ICMS->vCredICMSSN = ceil(round($item->imposto->ICMS->pCredSN
								                                               * $vBC_ICMS_CredSN / 100, 2) * 100)
								                                    / 100;
							}
						}
						break;
				}
			}
			else
			{
				/* N12a */
				$item->imposto->ICMS->CST = $tributacaoICMS->CST;
				$CST_ST                   = $item->imposto->ICMS->CST;
				/* Calcula valor de crédito do ICMS */
				switch($item->imposto->ICMS->CST)
				{
					case '00':
					case '10':
					case '20':
					case '30':
					case '40':
					case '41':
					case '50':
					case '51':
					case '70':
					case '90':
						$this->calcularTributacaoIntegral();
						
						break;
				}
			}
			
			if($tributacaoICMS->DestacarICMS == 1)
			{
				//Calculo da Partilha do ICMS
				//se a propriedade ICMSUFDest não é nula
				if($item->imposto->ICMSUFDest /* NA01 */)
				{
					$item->imposto->ICMSUFDest->vBCUFDest      = $item->imposto->ICMS->vICMS_Ficto;
					$item->imposto->ICMSUFDest->pFCPUFDest     = $tributacaoICMS->PercFCPUFDest;
					$item->imposto->ICMSUFDest->pICMSUFDest    = $tributacaoICMS->PercIcmsUFDest;
					$item->imposto->ICMSUFDest->pICMSInter     = $tributacaoICMS->AliquotaICMS;
					$item->imposto->ICMSUFDest->pICMSInterPart = $this->getDiferencialAliquota(date("Y"));
					$item->imposto->ICMSUFDest->vFCPUFDest     = $item->imposto->ICMSUFDest->vBCUFDest
					                                             * $item->imposto->ICMSUFDest->pFCPUFDest / 100;
					
					$diferencial_icms = ceil(round(($item->imposto->ICMSUFDest->vBCUFDest
					                                * $item->imposto->ICMSUFDest->pICMSUFDest / 100)
					                               - ($item->imposto->ICMSUFDest->vBCUFDest
					                                  * $item->imposto->ICMSUFDest->pICMSInter / 100)));
					
					if($diferencial_icms < 0)
					{
						$diferencial_icms = 0;
					}
					
					$item->imposto->ICMSUFDest->vICMSUFDest  = ceil(round($diferencial_icms
					                                                      * $item->imposto->ICMSUFDest->pICMSInterPart
					                                                      / 100));
					$item->imposto->ICMSUFDest->vICMSUFRemet = $diferencial_icms
					                                           - $item->imposto->ICMSUFDest->vICMSUFDest;
				}
			}
			
			/* Calcula do ICMS-ST */
			switch($CST_ST)
			{
				case '101':
				case '102':
				case '201':
				case '202':
				case '900':
				case '00':
				case '10':
				case '20':
				case '30':
				case '70':
				case '90':
					
					/* ======= Se existe informacao válida de ICMS ST ========================== */
					if(!empty($tributacaoICMS->ModalidadeBaseICMSST) && $tributacaoICMS->ModalidadeBaseICMSST >= 0)
					{
						/* N18 */
						$item->imposto->ICMS->modBCST = $tributacaoICMS->ModalidadeBaseICMSST;
						/* N20 */
						$item->imposto->ICMS->pRedBCST = (empty($tributacaoICMS->PercRedICMSST)) ? 0 : $tributacaoICMS->PercRedICMSST;
						/* N22 */
						$item->imposto->ICMS->pICMSST = $tributacaoICMS->AliquotaICMSST;
						
						/* Margem Valor Agregado (%) */
						if($item->imposto->ICMS->modBCST == 4)
						{
							/* Percentual MVA Ajustado */
							/* N18 */
							$item->imposto->ICMS->modBCST = $tributacaoICMS->ModalidadeBaseICMSST;
							/* N19 */
							$item->imposto->ICMS->pMVAST = $tributacaoICMS->PercMVAAjustadoST;
							/* ============= Base do ICMS-ST ================= */
							$vBC_ICMS_ST = $produto->vProd - $produto->vDesc + $produto->vFrete + $produto->vSeg
							               + $produto->vOutro;
							/* Incluindo IPI na base do ICMS-ST */
							
							//se o Emitente é contribuinte do IPI
							if($this->emit->ContribuinteIPI)
							{
								$vBC_ICMS_ST += (empty($item->imposto->IPI->vIPI)) ? 0 : $item->imposto->IPI->vIPI;
							}
							$vBC_ICMS_ST = round($vBC_ICMS_ST * (100 + $item->imposto->ICMS->pMVAST) / 100, 2);
							if($item->imposto->ICMS->pRedBCST > 0)
							{
								$vBC_ICMS_ST = round($vBC_ICMS_ST * (100 - $item->imposto->ICMS->pRedBCST) / 100, 2);
							}
							/* N21 */
							$item->imposto->ICMS->vBCST = number_format($vBC_ICMS_ST, 2, '.', '');
						}
						else
						{
							/* N21 */
							$item->imposto->ICMS->vBCST = $tributacaoICMS->BaseCalcICMSST;
						}
						
						/* N23 */
						$item->imposto->ICMS->vICMSST = number_format(round($item->imposto->ICMS->vBCST
						                                                    * $tributacaoICMS->AliquotaICMSST / 100, 2)
						                                              - $item->imposto->ICMS->vICMS_Ficto, 2, '.',
						                                              ''); //." - $vICMS - {$item->imposto->ICMS->vBCST}";
						if(!$tributacaoICMS->DestacarICMSST == 1)
						{
							
							/* Salva os valores do ICMS-ST Nao destacado */
							/* N21 */
							$item->imposto->ICMS->vBCST_NaoDestacado = $item->imposto->ICMS->vBCST;
							/* N23 */
							$item->imposto->ICMS->vICMSST_NaoDestacado = $item->imposto->ICMS->vICMSST;
							
							/* N18 */
							$item->imposto->ICMS->modBCST = null;
							/* N19 */
							$item->imposto->ICMS->pMVAST = null;
							/* N20 */
							$item->imposto->ICMS->pRedBCST = null;
							/* N21 */
							$item->imposto->ICMS->vBCST = null;
							/* N22 */
							$item->imposto->ICMS->pICMSST = null;
							/* N23 */
							$item->imposto->ICMS->vICMSST = null;
						}
						else
						{
							if($produto->FormaAquisicao == 1)
							{
								/* I08 */
								$item->prod->CFOP = $operacao->CFOPMercadoriaST;
							}
							else
							{
								/* I08 */
								$item->prod->CFOP = $operacao->CFOPProdutoST;
							}
						}
						//Calcula a partilha do ICMS
					}
					break;
				case '60':
				case '500':
					/* I08 */
					$item->prod->CFOP = $operacao->CFOPMercadoriaSTSubstituido;
					break;
			}
			
			/* Fim Calculo o Valor do ICMS */
			/* Calcula O Valor do ISSQN */
		}
		elseif($produto->tipoItem === 1)
		{
			$buscaTribFunctionISSQN = $this->buscaTribFunctionISSQN;
			if(!$this->objetoParametroPesquisa)
			{
				$tributacaoISSQN = $buscaTribFunctionISSQN($produto->identificador, $operacao->identificador,
				                                           $this->emit->identificador, $this->dest->identificador);
			}
			else
			{
				$tributacaoISSQN = $buscaTribFunctionISSQN($produto, $operacao, $this->emit, $this->dest);
			}
			
			unset($buscaTribFunctionISSQN);
			$item->imposto->ISSQN = new ISSQN();
			
			//Calculo dos impostos
			$desc                               = (empty($produto->vDesc)) ? 0 : $produto->vDesc;
			$dedu                               = (empty($produto->vDeducao)) ? 0 : $produto->vDeducao;
			$item->imposto->ISSQN->vBC          = $produto->vProd - $desc - $dedu;
			$item->imposto->ISSQN->vAliq        = $tributacaoISSQN->Aliquota;
			$item->imposto->ISSQN->vISSQN       = number_format($item->imposto->ISSQN->vBC
			                                                    * $item->imposto->ISSQN->vAliq / 100, 2, '.', '');
			$item->imposto->ISSQN->cMunFG       = $produto->cMunFG;
			$item->imposto->ISSQN->vDeducao     = $produto->vDeducao;
			$item->imposto->ISSQN->vDescIncond  = $produto->vDescIncond;
			$item->imposto->ISSQN->vDescCond    = $produto->vDescCond;
			$item->imposto->ISSQN->indISS       = $produto->indISS;
			$item->imposto->ISSQN->cServico     = $produto->cServico;
			$item->imposto->ISSQN->cMun         = $produto->cMun;
			$item->imposto->ISSQN->cPais        = $produto->cPais;
			$item->imposto->ISSQN->nProcesso    = $produto->nProcesso;
			$item->imposto->ISSQN->indIncentivo = $produto->indIncentivo;
			if(!$tributacaoISSQN->ISSRetemPF)
			{
				$tributacaoISSQN->ISSValorMinRetPF = -1;
			}
			if(!$tributacaoISSQN->ISSRetemPJ)
			{
				$tributacaoISSQN->ISSValorMinRetPJ = -1;
			}
			$vMinRetISS = (isset($this->emit->CPF)) ? $tributacaoISSQN->ISSValorMinRetPF : $tributacaoISSQN->ISSValorMinRetPJ;
			if($item->imposto->ISSQN->vISSQN > $vMinRetISS && $vMinRetISS > 0)
			{
				$item->imposto->ISSQN->vISSRet = $item->imposto->ISSQN->vISSQN;
			}
			
			if($tributacaoISSQN->IRRetem)
			{
				$item->imposto->ISSQN->vRetIR = number_format($item->imposto->ISSQN->vBC * $tributacaoISSQN->IRRetPerc
				                                              / 100, 2, '.', '');
			}
			if($tributacaoISSQN->CSLLRetem)
			{
				$item->imposto->ISSQN->vRetCSLL = number_format($item->imposto->ISSQN->vBC
				                                                * $tributacaoISSQN->CSLLRetPerc / 100, 2, '.', '');
			}
			if($tributacaoISSQN->INSSRetem)
			{
				$item->imposto->ISSQN->vRetINSS = number_format($item->imposto->ISSQN->vBC
				                                                * $tributacaoISSQN->INSSRetPerc / 100, 2, '.', '');
			}
			if($tributacaoISSQN->PISCOFINSRetem)
			{
				$item->imposto->ISSQN->vRetPIS    = number_format($item->imposto->ISSQN->vBC
				                                                  * $tributacaoISSQN->PISRetPerc / 100, 2, '.', '');
				$item->imposto->ISSQN->vRetCOFINS = number_format($item->imposto->ISSQN->vBC
				                                                  * $tributacaoISSQN->COFINSRetPerc / 100, 2, '.', '');
			}
			
			unset($tributacaoISSQN);
		}
		
		/* Busca as informações de Tributacao do PIS */
		$buscaTribFunctionPIS = $this->buscaTribFunctionPIS;
		
		if(!$this->objetoParametroPesquisa)
		{
			$tributacaoPIS = $buscaTribFunctionPIS($produto->identificador, $operacao->identificador,
			                                       $this->emit->identificador, $this->dest->identificador);
		}
		else
		{
			$tributacaoPIS = $buscaTribFunctionPIS($produto, $operacao, $this->emit, $this->dest);
		}
		$item->imposto->PIS->assign($tributacaoPIS);
		switch($tributacaoPIS->CST)
		{
			case '01':
			case '02':
				$item->imposto->PIS->CST  = $tributacaoPIS->CST;
				$item->imposto->PIS->pPIS = $tributacaoPIS->AliquotaPis;
				$item->imposto->PIS->vBC  = $produto->vProd - $produto->vDesc;
				$item->imposto->PIS->vPIS = number_format(ceil($item->imposto->PIS->vBC * $item->imposto->PIS->pPIS)
				                                          / 100, 2, '.', '');
				break;
			case '03':
				$item->imposto->PIS->CST       = $tributacaoPIS->CST;
				$item->imposto->PIS->qBCProd   = $produto->qTrib;
				$item->imposto->PIS->vAliqProd = $tributacaoPIS->ValorPIS;
				$item->imposto->PIS->vPIS      = $item->imposto->PIS->qBCProd * $item->imposto->PIS->vAliqProd;
				break;
			case '04':
			case '05':
			case '06':
			case '07':
			case '08':
			case '09':
				$item->imposto->PIS->CST = $tributacaoPIS->CST;
				break;
			default:
				if($tributacaoPIS->TipoTributacaoPISCOFINS == 0)
				{
					$item->imposto->PIS->CST  = $tributacaoPIS->CST;
					$item->imposto->PIS->pPIS = $tributacaoPIS->AliquotaPis;
					$item->imposto->PIS->vBC  = $produto->vProd - $produto->vDesc;
					$item->imposto->PIS->vPIS = ceil($item->imposto->PIS->vBC * $item->imposto->PIS->pPIS) / 100;
				}
				else
				{
					$item->imposto->PIS->CST       = $tributacaoPIS->CST;
					$item->imposto->PIS->qBCProd   = $produto->qTrib;
					$item->imposto->PIS->vAliqProd = $tributacaoPIS->ValorPIS;
					$item->imposto->PIS->vPIS      = $item->imposto->PIS->qBCProd * $item->imposto->PIS->vAliqProd;
				}
		}
		
		unset($tributacaoPIS);
		
		/* Calcula a Base do PIS */
		
		/* ================== Busca as informacoes de Tributacao do COFINS ==================== */
		$buscaTribFunctionCOFINS = $this->buscaTribFunctionCOFINS;
		if(!$this->objetoParametroPesquisa)
		{
			$tributacaoCOFINS = $buscaTribFunctionCOFINS($produto->identificador, $operacao->identificador,
			                                             $this->emit->identificador, $this->dest->identificador);
		}
		else
		{
			$tributacaoCOFINS = $buscaTribFunctionCOFINS($produto, $operacao, $this->emit, $this->dest);
		}
		
		$item->imposto->COFINS->assign($tributacaoCOFINS);
		/* Calcula a Base do COFINS */
		//$item->imposto->COFINS->CST = $tributacaoCOFINS->CST;
		switch($tributacaoCOFINS->CST)
		{
			case '01':
			case '02':
				$item->imposto->COFINS->CST     = $tributacaoCOFINS->CST;
				$item->imposto->COFINS->pCOFINS = $tributacaoCOFINS->AliquotaCofins;
				$item->imposto->COFINS->vBC     = $produto->vProd - $produto->vDesc;
				$item->imposto->COFINS->vCOFINS = ceil($item->imposto->COFINS->vBC * $item->imposto->COFINS->pCOFINS)
				                                  / 100;
				break;
			case '03':
				$item->imposto->COFINS->CST       = $tributacaoCOFINS->CST;
				$item->imposto->COFINS->qBCProd   = $produto->qTrib;
				$item->imposto->COFINS->vAliqProd = $tributacaoCOFINS->ValorCOFINS;
				$item->imposto->COFINS->vCOFINS   = $item->imposto->COFINS->qBCProd * $item->imposto->COFINS->vAliqProd;
				break;
			case '04':
			case '05':
			case '06':
			case '07':
			case '08':
			case '09':
				$item->imposto->COFINS->CST = $tributacaoCOFINS->CST;
				break;
			default:
				if($tributacaoCOFINS->TipoTributacaoPISCOFINS == 0)
				{
					$item->imposto->COFINS->CST     = $tributacaoCOFINS->CST;
					$item->imposto->COFINS->pCOFINS = $tributacaoCOFINS->AliquotaCofins;
					$item->imposto->COFINS->vBC     = $produto->vProd - $produto->vDesc;
					$item->imposto->COFINS->vCOFINS = ceil($item->imposto->COFINS->vBC
					                                       * $item->imposto->COFINS->pCOFINS) / 100;
				}
				else
				{
					$item->imposto->COFINS->CST       = $tributacaoCOFINS->CST;
					$item->imposto->COFINS->qBCProd   = $produto->qTrib;
					$item->imposto->COFINS->vAliqProd = $tributacaoCOFINS->ValorCOFINS;
					$item->imposto->COFINS->vCOFINS   = $item->imposto->COFINS->qBCProd
					                                    * $item->imposto->COFINS->vAliqProd;
				}
		}
		$item->nItem   = count($this->itens) + 1;
		$this->itens[] = $item;
		
		/* Retorno apenan para fins de consulta */
		
		return $item;
	}
	
	
	private function &calcularTributacaoIntegral(ItemFiscal &$item, $tributacaoICMS, $produto)
	{
		/* N13 */
		$item->imposto->ICMS->modBC = $tributacaoICMS->ModalidadeBaseICMS;
		if($item->imposto->ICMS->modBC == 3 || $item->imposto->ICMS->modBC == 0)
		{
			$vBC_ICMS = $produto->vProd - $produto->vDesc + $produto->vSeg + $produto->vOutro;
			if($tributacaoICMS->IncluirIPIBaseICMS && $this->emit->ContribuinteIPI)
			{
				$vBC_ICMS += is_numeric($item->imposto->IPI->vIPI) ? $item->imposto->IPI->vIPI : 0;
			}
			if($tributacaoICMS->IncluirFreteBaseICMS && is_numeric($produto->vFrete))
			{
				$vBC_ICMS += $produto->vFrete;
			}
			//aplica MVA sobre ICMS próprio
			if($item->imposto->ICMS->modBC == 0)
			{
				print_r($tributacaoICMS);
				$vBC_ICMS = $vBC_ICMS * (100 + $tributacaoICMS->PercMVAProprio) / 100;
			}
		}
		elseif($item->imposto->ICMS->modBC == 1 || $item->imposto->ICMS->modBC == 2)
		{
			$vBC_ICMS = $tributacaoICMS->ValorBaseICMS;
		}
		
		//calcula a redução da base de calculo apenas para os casos
		//que possuem redução de base de calculo.
		if($item->imposto->ICMS->CST == '20'
		   || $item->imposto->ICMS->CST == '51'
		   || $item->imposto->ICMS->CST == '70'
		   || $item->imposto->ICMS->CST == '90')
		{
			/* N14 */
			$item->imposto->ICMS->pRedBC      = $tributacaoICMS->PercRedICMS;
			$vBC_ICMS_Red                     = round($vBC_ICMS * (100 - $item->imposto->ICMS->pRedBC) / 100, 2);
			$item->imposto->ICMS->vICMS_Ficto = round($vBC_ICMS_Red * $tributacaoICMS->AliquotaICMS / 100, 2);
			
			if($tributacaoICMS->DestacarICMSDes)
			{
				$vICMSNorm = round($vBC_ICMS * $tributacaoICMS->AliquotaICMS / 100, 2);
				/* N27a */
				$item->imposto->ICMS->vICMSDeson = $vICMSNorm - $item->imposto->ICMS->vICMS_Ficto;
				/* N27a */
				$item->imposto->ICMS->motDesICMS = $tributacaoICMS->MotivoDesICMS;
			}
			$vBC_ICMS = $vBC_ICMS_Red;
		}
		else
		{
			$item->imposto->ICMS->vICMS_Ficto = round($vBC_ICMS * $tributacaoICMS->AliquotaICMS / 100, 2);
		}
		
		//destaca o ICMS apenas se estiver configurado para destacar o ICMS
		if($tributacaoICMS->DestacarICMS == 1)
		{
			/* N15 */
			$item->imposto->ICMS->vBC = number_format($vBC_ICMS, 2, '.', '');
			/* N17 */
			$item->imposto->ICMS->vICMS = number_format($item->imposto->ICMS->vICMS_Ficto, 2, '.', '');
			/* N16 */
			$item->imposto->ICMS->pICMS = $tributacaoICMS->AliquotaICMS;
			
			//Calculo da Partilha do ICMS
			//se a propriedade ICMSUFDest não é nula
			if($item->imposto->ICMSUFDest /* NA01 */)
			{
				$item->imposto->ICMSUFDest->vBCUFDest      = $item->imposto->ICMS->vBC;
				$item->imposto->ICMSUFDest->pFCPUFDest     = $tributacaoICMS->PercFCPUFDest;
				$item->imposto->ICMSUFDest->pICMSUFDest    = $tributacaoICMS->PercIcmsUFDest;
				$item->imposto->ICMSUFDest->pICMSInter     = $item->imposto->ICMS->pICMS;
				$item->imposto->ICMSUFDest->pICMSInterPart = $this->getDiferencialAliquota(date('Y'));
				
				$item->imposto->ICMSUFDest->vFCPUFDest = $item->imposto->ICMSUFDest->vBCUFDest
				                                         * $item->imposto->ICMSUFDest->pFCPUFDest / 100;
				
				$diferencial_icms = ceil(round(($item->imposto->ICMSUFDest->vBCUFDest
				                                * $item->imposto->ICMSUFDest->pICMSUFDest / 100)
				                               - $item->imposto->ICMS->vICMS));
				
				if($diferencial_icms < 0)
				{
					$diferencial_icms = 0;
				}
				
				$item->imposto->ICMSUFDest->vICMSUFDest  = ceil(round($diferencial_icms
				                                                      * $item->imposto->ICMSUFDest->pICMSInterPart
				                                                      / 100));
				$item->imposto->ICMSUFDest->vICMSUFRemet = $diferencial_icms - $item->imposto->ICMSUFDest->vICMSUFDest;
			}
		}
		
		if($item->imposto->ICMS->CST == '51')
		{
			$item->imposto->ICMS->vBC = ceil($vBC_ICMS * 100) / 100;
			/* N16 */
			$item->imposto->ICMS->pICMS = $tributacaoICMS->AliquotaICMS;
			/* N16a */
			$item->imposto->ICMS->vICMSOp = ceil($item->imposto->ICMS->vICMS_Ficto * 100) / 100;
			/* N16b */
			$item->imposto->ICMS->pDif = $tributacaoICMS->PercDiferimento;
			/* N16c */
			$item->imposto->ICMS->vICMSDif = ceil(round($item->imposto->ICMS->vICMS_Ficto
			                                            - ($item->imposto->ICMS->vICMS_Ficto
			                                               * $tributacaoICMS->PercDiferimento / 100), 2) * 100) / 100;
			/* N17 */
			$item->imposto->ICMS->vICMS = $item->imposto->ICMS->vICMS_Ficto - $item->imposto->ICMS->vICMSDif;
		}
		
		return $item;
	}
	
	
	private function getDiferencialAliquota($year)
	{
		switch($year)
		{
			case 2016:
				$result = 40;
				break;
			case 2017:
				$result = 60;
				break;
			case 2018:
				$result = 80;
				break;
			default:
				$result = 100;
				break;
		}
		
		return $result;
	}
	
	
	function totalizarDocumento()
	{
		$vRetServ       = 0;
		$vRetPISServ    = 0;
		$vRetPIS        = 0;
		$vRetCOFINSServ = 0;
		$vRetCOFINS     = 0;
		$vRetCSLLServ   = 0;
		$vRetINSSServ   = 0;
		$vBaseINSSServ  = 0;
		$vRetIRServ     = 0;
		$vBaseIRServ    = 0;
		$vRetISSServ    = 0;
		$vISSQNServ     = 0;
		$vBcISSQNServ   = 0;
		$vTotPisServ    = 0;
		$vTotCofinsServ = 0;
		$vTotDeducao    = 0;
		$vTotDescIncond = 0;
		$vTotDescCond   = 0;
		
		$this->ICMSTot = new ICMSTot();
		
		foreach($this->itens as $item)
		{
			if($item->prod->tipoItem == 0)
			{
				$this->ICMSTot->vBC        += (is_numeric($item->imposto->ICMS->vBC)) ? str_replace(",", "",
				                                                                                    $item->imposto->ICMS->vBC) : 0;
				$this->ICMSTot->vICMS      += (is_numeric($item->imposto->ICMS->vICMS)) ? str_replace(",", "",
				                                                                                      $item->imposto->ICMS->vICMS) : 0;
				$this->ICMSTot->vICMSDeson += (is_numeric($item->imposto->ICMS->vICMSDeson)) ? str_replace(",", "",
				                                                                                           $item->imposto->ICMS->vICMSDeson) : 0;
				$this->ICMSTot->vBCST      += (is_numeric($item->imposto->ICMS->vBCST)) ? str_replace(",", "",
				                                                                                      $item->imposto->ICMS->vBCST) : 0;
				$this->ICMSTot->vST        += (is_numeric($item->imposto->ICMS->vICMSST)) ? str_replace(",", "",
				                                                                                        $item->imposto->ICMS->vICMSST) : 0;
				$this->ICMSTot->vProd      += (is_numeric($item->prod->vProd)) ? str_replace(",", "",
				                                                                             $item->prod->vProd) : 0;
				$this->ICMSTot->vFrete     += (is_numeric($item->prod->vFrete)) ? str_replace(",", "",
				                                                                              $item->prod->vFrete) : 0;
				$this->ICMSTot->vSeg       += (is_numeric($item->prod->vSeg)) ? str_replace(",", "",
				                                                                            $item->prod->vSeg) : 0;
				$this->ICMSTot->vDesc      += (is_numeric($item->prod->vDesc)) ? str_replace(",", "",
				                                                                             $item->prod->vDesc) : 0;
				$this->ICMSTot->vOutro     += (is_numeric($item->prod->vOutro)) ? str_replace(",", "",
				                                                                              $item->prod->vOutro) : 0;
				
				if(!empty($item->imposto->vTotTrib))
				{
					$this->ICMSTot->vTotTrib += $item->imposto->vTotTrib;
				}
				$this->ICMSTot->vII += 0;
				
				if(isset($item->imposto->IPI))
				{
					$this->ICMSTot->vIPI += $item->imposto->IPI->vIPI;
				}
				
				$this->ICMSTot->vPIS    += $item->imposto->PIS->vPIS;
				$this->ICMSTot->vCOFINS += $item->imposto->COFINS->vCOFINS;
				
				//Totalização da partilha do ICMS
				//se a propriedade ICMSUFDest não é nula
				if($item->imposto->ICMSUFDest)
				{
					
					//inicializando variáveis
					if($this->ICMSTot->vFCPUFDest == null)
					{
						$this->ICMSTot->vFCPUFDest = 0;
					}
					if($this->ICMSTot->vICMSUFDest == null)
					{
						$this->ICMSTot->vICMSUFDest = 0;
					}
					if($this->ICMSTot->vICMSUFRemet == null)
					{
						$this->ICMSTot->vICMSUFRemet = 0;
					}
					
					//totalizando variáveis
					$this->ICMSTot->vFCPUFDest   += $item->imposto->ICMSUFDest->vFCPUFDest;
					$this->ICMSTot->vICMSUFDest  += $item->imposto->ICMSUFDest->vICMSUFDest;
					$this->ICMSTot->vICMSUFRemet += $item->imposto->ICMSUFDest->vICMSUFRemet;
				}
				//Item de serviço
			}
			else
			{
				$vRetPISServ    += $item->imposto->ISSQN->vRetPIS;
				$vRetPIS        += $item->imposto->ISSQN->vRetPIS;
				$vRetCOFINSServ += $item->imposto->ISSQN->vRetCOFINS;
				$vRetCOFINS     += $item->imposto->ISSQN->vRetCOFINS;
				$vRetCSLLServ   += $item->imposto->ISSQN->vRetCSLL;
				$vRetINSSServ   += $item->imposto->ISSQN->vRetINSS;
				$vRetIRServ     += $item->imposto->ISSQN->vRetIR;
				$vBaseIRServ    += $item->imposto->ISSQN->vBC;
				$vRetISSServ    += $item->imposto->ISSQN->vISSRet;
				$vISSQNServ     += $item->imposto->ISSQN->vISSQN;
				$vBaseINSSServ  += $item->imposto->ISSQN->vBC;
				$vTotPisServ    += $item->imposto->PIS->vPIS;
				$vTotCofinsServ += $item->imposto->COFINS->vCOFINS;
				$vTotDeducao    += $item->imposto->ISSQN->vDeducao;
				$vTotDescIncond += $item->imposto->ISSQN->vDescIncond;
				$vTotDescCond   += $item->imposto->ISSQN->vDescCond;
			}
		}
		
		$this->ICMSTot->vNF = $this->ICMSTot->vProd - $this->ICMSTot->vDesc - $this->ICMSTot->vICMSDeson
		                      + $this->ICMSTot->vST + $this->ICMSTot->vFrete + $this->ICMSTot->vSeg
		                      + $this->ICMSTot->vOutro + $this->ICMSTot->vII + $this->ICMSTot->vIPI;
		
		//Retenção de PIS, COFINS e CSLL - Contribuições
		if(($vRetPISServ + $vRetCOFINSServ + $vRetCSLLServ) <= 10)
		{
			$vRetPISServ    = 0;
			$vRetCOFINSServ = 0;
			$vRetCSLLServ   = 0;
		}
		
		//Retenção de INSS
		if(($vRetINSSServ) <= 10)
		{
			$vRetINSSServ  = 0;
			$vBaseINSSServ = 0;
		}
		
		//Retenção de IR
		if(($vRetIRServ) <= 10)
		{
			$vRetIRServ  = 0;
			$vBaseIRServ = 0;
		}
		
		$vTotOutroServ = $this->AjustarRetencaoServ($vRetPISServ + $vRetCOFINSServ + $vRetCSLLServ, $vRetIRServ,
		                                            $vRetINSSServ);
		
		if($vISSQNServ > 0)
		{
			$this->ISSQNtot          = new \stdClass();
			$this->ISSQNtot->vServ   = $vBaseIRServ;
			$this->ISSQNtot->vBC     = $vBaseIRServ;
			$this->ISSQNtot->vISS    = $vISSQNServ;
			$this->ISSQNtot->vPIS    = $vTotPisServ;
			$this->ISSQNtot->vCOFINS = $vTotCofinsServ;
			//$this->ISSQNtot->dCompet = $vBaseINSSServ;
			$this->ISSQNtot->vDeducao    = $vTotDeducao;
			$this->ISSQNtot->vOutro      = $vTotOutroServ;
			$this->ISSQNtot->vDescIncond = $vTotDescIncond;
			$this->ISSQNtot->vDescCond   = $vTotDescCond;
			$this->ISSQNtot->vISSRet     = $vRetISSServ;
			//$this->ISSQNtot->cRegTrib = $vRetINSSServ;
		}
		
		$vRet = $vRetPISServ + $vRetCOFINSServ + $vRetCSLLServ + $vRetINSSServ + $vRetIRServ;
		if($vRet > 0)
		{
			$this->retTrib             = new RetTrib();
			$this->retTrib->vRetPIS    = $vRetPIS;
			$this->retTrib->vRetCOFINS = $vRetCOFINS;
			$this->retTrib->vRetCSLL   = $vRetCSLLServ;
			$this->retTrib->vBCIRRF    = $vBaseIRServ;
			$this->retTrib->vIRRF      = $vRetIRServ;
			$this->retTrib->vBCRetPrev = $vBaseINSSServ;
			$this->retTrib->vRetPrev   = $vRetINSSServ;
		}
	}
	
	
	function AjustarRetencaoServ($contribuicoes, $ir, $inss)
	{
		$vOutroTot = 0;
		foreach($this->itens as $key => $item)
		{
			
			if($item->prod->tipoItem != 0)
			{
				$vOutro = 0;
				if($contribuicoes > 0)
				{
					$vOutro += $item->imposto->ISSQN->vRetPIS + $item->imposto->ISSQN->vRetCOFINS
					           + $item->imposto->ISSQN->vRetCSLL;
				}
				if($ir > 0)
				{
					$vOutro += $item->imposto->ISSQN->vRetIR;
				}
				if($inss > 0)
				{
					$vOutro += $item->imposto->ISSQN->vRetINSS;
				}
				
				$this->itens[$key]->imposto->ISSQN->vOutro = $vOutro;
				$vOutroTot                                 += $vOutro;
			}
		}
		
		return $vOutroTot;
	}
	
}
