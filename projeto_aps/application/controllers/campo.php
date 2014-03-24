<?php

/*
 * Não esquecer de chamar as views corretas no decorrer do código
 * 
 */
class Campo extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('campo_model');
        $this->load->helper('url_helper');
        $this->load->library(array ('form_validation', 'session'));
        $this->form_validation->set_rules('nomeCampo', 'Nome Campo', 'required|max_length[50]');
        $this->form_validation->set_rules('tipoCampo', 'Tipo Campo', 'required');
        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
    }
    
     public function index()
    {
        $this->load->view('campo_view');
    }
    
    public function cadastrar()
    {
        if ($this->form_validation->run() === true) {
            try {
                $this->campo_model->save(array(
                    $this->input->post('nomeCampo'),
                    $this->input->post('tipoCampo'),
                ));   
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('campo_view');
        }
    }
    
    public function mostrarCampo($id)
    {
        try {
            $vetor = $this->campo_model->getById($id);
            $this->load->view('campo_view', array(
                'campo' => $campo
            ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function mostrarTodosCampos()
    {
        try {
            $campo = $this->campo_model->listAll();
            $this->load->view('campo_view', array(
                'campo' => $campo,
            ));

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
   
    public function atualizarCampo($id)
    {
        try {
            $campo = $this->campo_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->campo_model->updateCampo($id, array(
                        $this->input->post('nomeCampo'),
                        $this->input->post('tipoCampo'),
                    ));
                    $this->session->set_flashdata('feedback', 'Dados atualizados com sucesso!');
                } else {
                    $this->load->view('campo_view', array(
                        'campo' => $campo,
                    ));
                }
            } else {
                $this->load->view('campo_view', array(
                    'campo' => $campo,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarCampo($id)
    {
         try {
            $this->campo_model->deleteCampo($id);
            $this->session->set_flashdata('feedback', 'Campo apagado com sucesso!');
        } catch (Exception $e) {
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }
}