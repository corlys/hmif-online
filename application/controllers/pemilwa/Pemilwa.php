<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemilwa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pemilwa/epemilwa', 'model_pemilwa');
        $this->load->model('pemilwa/reg_pemilwa', 'model_reg');
        include('simple_html_dom.php');
    }

    public function beginPemilwa()
    {
        // echo $this->session->userdata('cry');
        $user_data = $this->session->userdata('cry');
        if ($user_data != null) {
            // $data['name'] = $_SESSION['name'];

            //check udah vote apa bnelum

            if ($this->model_pemilwa->udahPilih($this->session->userdata('cry'))) {
                // print_r($this->session->userdata('cry'));
                redirect(base_url());
            } else {
                $data['name'] = $this->session->userdata('name');;
                //belum pilih
                $this->parser->parse('pemilwa/form_pemilwa_trika', $data);
            }
        } else {
            redirect(base_url());
        }
        // $data['status'] = FALSE;
        //$this->form_validation->set_rules('nim', 'Nim', 'required|exact_length[15]|callback_nim_check');
    }

    public function testqc()
    {
        // $data['result1'] =  $this->model_pemilwa->qCount("saWfP.yNJuddo");
        // $data['result2'] =  $this->model_pemilwa->qCount("saPDeb84AwR6U");
        // $data['result3'] =  $this->model_pemilwa->qCount("saasALRQ3i.eA");
        // $data['title'] = "PEMILWA 2020";
        // // print_r($data);

        // $this->parser->parse('pemilwa/result', $data);
    }

    public function result()
    {
        $pass = $this->input->get('pass');
        if ($pass === "472cd783-043c-4727-b5af-53703dfc2bc7") {
            $data['result1'] =  $this->model_pemilwa->qCount("saWfP.yNJuddo");
            $data['result2'] =  $this->model_pemilwa->qCount("saPDeb84AwR6U");
            $data['result3'] =  $this->model_pemilwa->qCount("saasALRQ3i.eA");
            $data['title'] = "PEMILWA 2020";
            $this->parser->parse('pemilwa/result', $data);
        } else {
            echo "not allowed";
        }
    }

    public function pote()
    {
        $errors = array();      // array to hold validation errors
        $data = array();      // array to pass back data
        // 
        $sallydontgo = "saltysplatoon";
        //
        if (empty($errors)) {
            if ($this->input->post('calon') && $this->session->userdata('cry')) {

                $isSuccess = false;

                $md5nim = md5($this->input->post('calon'));
                $shanim = sha1($md5nim);
                $cryptnim = crypt($shanim, $sallydontgo);

                $isSuccess = $this->model_pemilwa->pote($cryptnim);

                if ($isSuccess) {

                    $user_data = $this->session->userdata('cry');

                    if ($user_data != null) {
                        $this->session->sess_destroy();

                        $data['success'] = true;
                        $data['message'] = "Terima Kasih Karena Telah Mengikuti PEMILWA 2020";
                    }
                } else {
                    $data['success'] = false;
                    $data['message'] = "Error Insert Data";
                }
            } else {
                $data['success'] = $this->input->post('calon');;
                $data['message'] = "Error pada Form";
            }
        } else {
            $data['success'] = false;
            $data['message'] = "Ada Error";
        }
        echo json_encode($data);
    }

    public function farewallPage()
    {
        // echo "saty";
        $this->load->view('pemilwa/thankyou_page');
    }
}
