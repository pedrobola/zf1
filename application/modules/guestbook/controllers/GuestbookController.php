<?php

class Guestbook_GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $guestbook = new Guestbook_Model_GuestbookMapper();        
        $this->view->entries = $guestbook->fetchAll();
    }

    public function signAction()
    {
        $request = $this->getRequest();
        $form    = new Guestbook_Form_Guestbook();
		//var_dump($form->isValid($request->getPost()), $form->getMessages());
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Guestbook_Model_Guestbook($form->getValues());
                $mapper  = new Guestbook_Model_GuestbookMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }


}



