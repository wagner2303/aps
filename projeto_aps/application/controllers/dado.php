<?php
class Dado extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('dado_model');
        $this->load->helper('url_helper');
        $this->load->library(array ('form_validation', 'session'));
        $this->form_validation->set_rules('valor', 'Valor', 'required|max_length[255]');
        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
    }
    
     public function index()
    {
        $this->load->view('dado_view');
    }
    
    public function cadastrar()
    {
        if ($this->form_validation->run() === true) {
            try {
                $this->dado_model->save(array(
                    $this->input->post('dado'),
                ));   
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('dado_view');
        }
    }
    
    public function mostrarDado($id)
    {
        try {
            $vetor = $this->dado_model->getById($id);
            $this->load->view('dado_view', array(
                'dado' => $dado
            ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function mostrarTodosDados()
    {
        try {
            $vetor = $this->dado_model->listAll();
            $this->load->view('dado_view', array(
                'dado' => $dado,
            ));

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
   
    public function atualizarDado($id)
    {
        try {
            $dado = $this->dado_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->dado_model->updateDado($id, array(
                        $this->input->post('valor'),
                    ));
                    $this->session->set_flashdata('feedback', 'Dados atualizados com sucesso!');
                } else {
                    $this->load->view('dado_view', array(
                        'dado' => $dado,
                    ));
                }
            } else {
                $this->load->view('dado_view', array(
                    'dado' => $dado,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarDado($id)
    {
         try {
            $this->dado_model->deleteDado($id);
            $this->session->set_flashdata('feedback', 'Dado excluido com sucesso!');
        } catch (Exception $e) {
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }
}
