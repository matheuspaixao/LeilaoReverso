<?php

namespace App\Controllers;

use Core\BaseController;
use Src\Classes\Produto;
use Core\Container;
use Core\Redirect;
use Core\Session;

class ProdutoController extends BaseController
{
  protected $listaProdutos;
  protected $produto;
  protected $undMedidas;
  protected $titleHeader;
    
  public function listar() {
    $produtoModel = Container::getModel('Produto');
    
    if (Session::get('buscarProdutos')) {
      $buscarProdutos = Session::get('buscarProdutos');
      Session::destroy('buscarProdutos');
      $this->listaProdutos = $produtoModel->getProducts($buscarProdutos);
    }
    else {
      $this->listaProdutos = $produtoModel->getProducts();
    }    
    
    $this->setPageTitle('Produtos');
    $this->renderView('produto/listar', 'layout');
  }
  
  public function cadastrar($request) {
    if (isset($request->post->nome)) {
      $this->popularProduto($request, 'id_usr_cad');
      $produtoModel = Container::getModel('Produto');
      $produtoModel->insert($this->produto);
      Redirect::route('/produtos');
    } else {
      $this->produto = new Produto();
      $undMedidaModel = Container::getModel('UndMedida');
      $this->undMedidas = $undMedidaModel->getUndMedidas();
      $this->titleHeader = 'Cadastrar produto';
      $this->setPageTitle('Cadastrar Produto');
      $this->renderView('produto/cadastrar_atualizar', 'layout');
    }    
  }

  public function atualizar($id, $request) {
    if (isset($request->post->nome))  {
      $this->popularProduto($request, 'id_usr_alter');
      $produtoModel = Container::getModel('Produto');
      $produtoModel->update($this->produto);
      Redirect::route('/produtos');
    } else {
      $produtoModel = Container::getModel('Produto');
      $this->produto = $produtoModel->getProductById($id);   
      $undMedidaModel = Container::getModel('UndMedida');
      $this->undMedidas = $undMedidaModel->getUndMedidas($this->produto->id_und_medida);
      $this->titleHeader = 'Alterar produto';
      $this->setPageTitle('Cadastrar Produto');
      $this->renderView('produto/cadastrar_atualizar', 'layout');
    }
  }

  public function excluir($id) {
    $produtoModel = Container::getModel('Produto');
    $produtoModel->delete($id);
    Redirect::route('/produtos');
  }

  private function popularProduto($request, $id_usr) {
    $this->produto = new Produto();
    $this->produto->id = $request->post->acaoAndIdUser;
    $this->produto->nome = $request->post->nome;
    $this->produto->id_und_medida = $request->post->id_und_medida;
    $this->produto->descricao = $request->post->descricao;
    $this->produto->$id_usr = Session::get('usuario')->id; //pode ser id_usr_alter ou id_usr_cad
  }
}