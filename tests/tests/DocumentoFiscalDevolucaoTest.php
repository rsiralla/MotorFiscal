<?php

use MotorFiscal\Destinatario;
use MotorFiscal\DocumentoFiscal;
use MotorFiscal\Emitente;
use MotorFiscal\Operacao;
use MotorFiscal\Produto;
use PHPUnit\Framework\TestCase;

class DocumentoFiscalDevolucaoTest extends TestCase
{
    /**
     * @var \MotorFiscal\DocumentoFiscal
     */
    protected $NF;

    /**
     * @var ICMS
     */
    protected $object;

    public function testCSOSN101IPI_ICMSSTND()
    {
        $prod = new Produto();
        $prod->identificador = 1;
        $prod->TipoTributacaoIPI = 0;
        $prod->FormaAquisicao = 1; //Adiquirida de Terceiros
        $prod->vProd = 100;
        $prod->vDesc = 10;
        $prod->vFrete = 10;
        $prod->vOutro = 10;
        $prod->vSeg = 10;
        $this->NF->itens = [];

        $item = &$this->NF->addItem($prod);
        $this->NF->totalizarDocumento();
        $this->assertEquals(null, $item->imposto->ICMS->CST, 'CST');
        $this->assertEquals(101, $item->imposto->ICMS->CSOSN, 'CSOSN');
        $this->assertEquals(null, $item->imposto->ICMS->modBC, 'modBC');
        $this->assertEquals(null, $item->imposto->ICMS->pRedBC, 'pRedBC');
        $this->assertEquals(null, $item->imposto->ICMS->vBC, 'vBC');
        $this->assertEquals(null, $item->imposto->ICMS->vBC_Desonerado, 'vBC_Desonerado');
        $this->assertEquals(null, $item->imposto->ICMS->pICMS, 'pICMS');
        $this->assertEquals(null, $item->imposto->ICMS->pICMS_Desonerado, 'pICMS_Desonerado');
        $this->assertEquals(null, $item->imposto->ICMS->pDif, 'pDif');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSDif, 'vICMSDif');
        $this->assertEquals(null, $item->imposto->ICMS->vICMS, 'vICMS');
        $this->assertEquals(null, $item->imposto->ICMS->vICMS_Desonerado, 'vICMS_Desonerado');
        $this->assertEquals(null, $item->imposto->ICMS->modBCST, 'modBCST');
        $this->assertEquals(null, $item->imposto->ICMS->pMVAST, 'pMVAST');
        $this->assertEquals(null, $item->imposto->ICMS->pRedBCST, 'pRedBCST');
        $this->assertEquals(null, $item->imposto->ICMS->vBCST, 'vBCST');
        $this->assertEquals(258, $item->imposto->ICMS->vBCST_NaoDestacado, 'vBCST_NaoDestacado');
        $this->assertEquals(null, $item->imposto->ICMS->pICMSST, 'pICMSST');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSST, 'vICMSST');
        $this->assertEquals('29.46', $item->imposto->ICMS->vICMSST_NaoDestacado, 'vICMSST_NaoDestacado');
        $this->assertEquals(null, $item->imposto->ICMS->UFST, 'UFST');
        $this->assertEquals(null, $item->imposto->ICMS->pBCOp, 'pBCOp');
        $this->assertEquals(null, $item->imposto->ICMS->vBCSTRet, 'vBCSTRet');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSSTRet, 'vICMSSTRet');
        $this->assertEquals(null, $item->imposto->ICMS->UFST, 'UFST');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSDeson, 'vICMSDeson');
        $this->assertEquals(null, $item->imposto->ICMS->motDesICMS, 'motDesICMS');
        $this->assertEquals(5, $item->imposto->ICMS->pCredSN, 'pCredSN');
        $this->assertEquals(6.0, $item->imposto->ICMS->vCredICMSSN, 'vCredICMSSN');
        $this->assertEquals(null, $item->imposto->ICMS->vBCSTDest, 'vBCSTDest');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSSTDest, 'vICMSSTDest');
        $this->assertEquals(1, $item->nItem, 'N�mero do Item');
    }

    public function testCSOSN900IPI()
    {
        $prod = new Produto();
        $prod->identificador = 3;
        $prod->TipoTributacaoIPI = 0;
        $prod->FormaAquisicao = 1; //Adiquirida de Terceiros
        $prod->vProd = 100;
        $prod->vDesc = 0;
        $prod->vFrete = 0;
        $prod->vOutro = 0;
        $prod->vSeg = 0;
        $this->NF->itens = [];

        $item = &$this->NF->addItem($prod);
        $this->NF->totalizarDocumento();
        $this->assertEquals(null, $item->imposto->ICMS->CST, 'CST');
        $this->assertEquals(900, $item->imposto->ICMS->CSOSN, 'CSOSN');
        $this->assertEquals(3, $item->imposto->ICMS->modBC, 'modBC');
        $this->assertEquals(50, $item->imposto->ICMS->pRedBC, 'pRedBC');
        $this->assertEquals(50, $item->imposto->ICMS->vBC, 'vBC');
        $this->assertEquals(null, $item->imposto->ICMS->vBC_Desonerado, 'vBC_Desonerado');
        $this->assertEquals(12, $item->imposto->ICMS->pICMS, 'pICMS');
        $this->assertEquals(null, $item->imposto->ICMS->pICMS_Desonerado, 'pICMS_Desonerado');
        $this->assertEquals(null, $item->imposto->ICMS->pDif, 'pDif');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSDif, 'vICMSDif');
        $this->assertEquals(6, $item->imposto->ICMS->vICMS, 'vICMS');
        $this->assertEquals(null, $item->imposto->ICMS->vICMS_Desonerado, 'vICMS_Desonerado');
        $this->assertEquals(null, $item->imposto->ICMS->modBCST, 'modBCST');
        $this->assertEquals(null, $item->imposto->ICMS->pMVAST, 'pMVAST');
        $this->assertEquals(null, $item->imposto->ICMS->pRedBCST, 'pRedBCST');
        $this->assertEquals(null, $item->imposto->ICMS->vBCST, 'vBCST');
        $this->assertEquals(null, $item->imposto->ICMS->vBCST_NaoDestacado, 'vBCST_NaoDestacado');
        $this->assertEquals(null, $item->imposto->ICMS->pICMSST, 'pICMSST');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSST, 'vICMSST');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSST_NaoDestacado, 'vICMSST_NaoDestacado');
        $this->assertEquals(null, $item->imposto->ICMS->UFST, 'UFST');
        $this->assertEquals(null, $item->imposto->ICMS->pBCOp, 'pBCOp');
        $this->assertEquals(null, $item->imposto->ICMS->vBCSTRet, 'vBCSTRet');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSSTRet, 'vICMSSTRet');
        $this->assertEquals(null, $item->imposto->ICMS->UFST, 'UFST');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSDeson, 'vICMSDeson');
        $this->assertEquals(null, $item->imposto->ICMS->motDesICMS, 'motDesICMS');
        $this->assertEquals(null, $item->imposto->ICMS->pCredSN, 'pCredSN');
        $this->assertEquals(null, $item->imposto->ICMS->vCredICMSSN, 'vCredICMSSN');
        $this->assertEquals(null, $item->imposto->ICMS->vBCSTDest, 'vBCSTDest');
        $this->assertEquals(null, $item->imposto->ICMS->vICMSSTDest, 'vICMSSTDest');
        $this->assertEquals(1, $item->nItem, 'Número do Item');
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $emitente = new Emitente();
        $emitente->identificador = 1;
        $emitente->CRT = 1;
        $emitente->ContribuinteIPI = 1;
        $emitente->PercCreditoSimples = 5;
        $destinatario = new Destinatario();
        $destinatario->identificador = 1;
        $operacao = new Operacao();
        $operacao->identificador = 1;
        $operacao->CFOPMercadoria = 1202;
        $operacao->CFOPMercadoriaST = 1202;
        $operacao->CFOPMercadoriaSTSubstituido = 1202;
        $operacao->CFOPProduto = 1202;
        $operacao->CFOPProdutoST = 1202;
        $this->NF = new DocumentoFiscal($emitente, $destinatario, $operacao);

        $this->NF->tipoParametroPesquisa = true;

        $this->NF->buscaTribFunctionICMS = function (Produto $produto,
                                                     Operacao $operacao,
                                                     Emitente $emitente,
                                                     Destinatario $destinatario) {
            return Trib::ICMS($produto->identificador, $operacao->identificador, $emitente->identificador,
                              $destinatario->identificador);
        };
        $this->NF->buscaTribFunctionIPI = function (Produto $produto,
                                                     Operacao $operacao,
                                                     Emitente $emitente,
                                                     Destinatario $destinatario) {
            return Trib::IPI($produto->identificador, $operacao->identificador, $emitente->identificador,
                             $destinatario->identificador);
        };

        $this->NF->buscaTribFunctionPIS = function (Produto $produto,
                                                    Operacao $operacao,
                                                    Emitente $emitente,
                                                    Destinatario $destinatario) {
            return Trib::PIS($produto->identificador, $operacao->identificador, $emitente->identificador,
                             $destinatario->identificador);
        };

        $this->NF->buscaTribFunctionCOFINS = function (Produto $produto,
                                                       Operacao $operacao,
                                                       Emitente $emitente,
                                                       Destinatario $destinatario) {
            return Trib::COFINS($produto->identificador, $operacao->identificador, $emitente->identificador,
                                $destinatario->identificador);
        };
    }
}
