<?php

class Album_AlbumController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
	
    /**
     *  lista os albuns cadastrados
     */
	public function indexAction()
	{	
		// instancia o album table
		$albumTable = new Album_Model_AlbumTable();
		
		// recupera os albuns existente a atribui a variavel entries da visao
		$this->view->entries = $albumTable->fetchAll();
	}
	
	/**
	 * add um novo album
	 */
	function addAction()
	{
		// instancia o formulario do album
		$form = new Album_Form_AlbumForm();
		
		// altera o valor do botao submit
		$form->submit->setLabel('Add');
		
		// verifica se a requisicao eh um post
		if ($this->getRequest()->isPost()) {
			
			// recuper os dados do post
			$formData = $this->getRequest()->getPost();
			
			// verifica se o formulario eh valido com o valores do post
			if ($form->isValid($formData)) {
				// instancia a entidade album
				$album = new Album_Model_Album();
				
				// popula a entidade album
				$album->populate($formData);
				
				// instancia dbTable para album
				$albumTable = new Album_Model_AlbumTable();
				
				// salva o album
				$albumTable->saveAlbum($album);
				
				// redireciona para a index
				$this->_helper->redirector('index');
			} else {
				$form->populate($formData);
			}
		}
		
		// artibui form a variavel da visao
		$this->view->form = $form;
	}
	
	/**
	 * edita um album existente
	 */
	public function editAction()
	{
		// instancia o formulario
		$form = new Album_Form_AlbumForm();
		
		// altera o valor do botao do submit
		$form->submit->setLabel('Save');
		
		// verifica se a requisicao eh post
		if ($this->getRequest()->isPost()) {
			
			// recupera os valores do post
			$formData = $this->getRequest()->getPost();
			
			// verifica se o formulario eh valido com o valores do post
			if ($form->isValid($formData)) {
				// instancia a entidade album
				$album = new Album_Model_Album();
				
				// popula a entidade album
				$album->populate($formData);
				
				// instancia dbTable para album
				$albumTable = new Album_Model_AlbumTable();
				
				// salva o album
				$albumTable->saveAlbum($album);
				
				// redireciona para a index
				$this->_helper->redirector('index');
			} else {
				// preenche o formulario com os valores do post
				$form->populate($formData);
			}
		} else {
			// recupera o valor do id na url
			$id = $this->_getParam('id', 0);
			
			if ($id > 0) {
				// instancia o album table
				$album = new Album_Model_AlbumTable();
				
				// preenche o formulario com o valor do album para o id solicitado
				$form->populate($album->getAlbum($id));
			}
		}
		
		// artibui form a variavel da visao
		$this->view->form = $form;
	}
	
	/**
	 *  remove um album cadastrado
	 */
	public function deleteAction()
	{
		// verifica se a requisicao eh um post
		if ($this->getRequest()->isPost()) {
			
			// recupera resposta para a confirmacao da remocao
			$del = $this->getRequest()->getPost('del');
			
			// se a resposta for positiva
			if ($del == 'Yes') {
				
				// captura o id do album a ser removido
				$id = $this->getRequest()->getPost('id');
				
				// instancia o table para o album
				$albumTable = new Album_Model_AlbumTable();
				
				// remove o album pelo seu id
				$albumTable->deleteAlbum($id);
			}
			
			// redireciona para a index
			$this->_helper->redirector('index');
		} else {
			// recupera o id do album
			$id = $this->_getParam('id', 0);
			
			// instancia o table para o album
			$albumTable = new Album_Model_AlbumTable();
			
			// recupera as informacoes do album pelo id e atribui a variavel album da visao
			$this->view->album = $albumTable->getAlbum($id);
		}
	}
}