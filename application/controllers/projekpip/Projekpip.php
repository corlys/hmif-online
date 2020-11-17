<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projekpip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        include('simple_html_dom.php');
        // $this->load->library('Ajax_pagination');
        $this->load->model('pip/projekpip/User', 'user_model'); //model user
        $this->load->model('pip/projekpip/Post', 'post_model'); //model post

        // Per page limit 
        // $this->perPage = 4;
        // $this->load->model(); // model like (?)
    }

    public function index()
    {

        // PAGINATION
        $config['base_url'] = base_url() . "projekpip/";
        $config['total_rows'] = $this->post_model->countAllPosts();
        $data['total_rows'] = $this->post_model->countAllPosts();
        $config['per_page'] =  6;
        $config['uri_segment'] = 2;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = "First";
        $config['first_tag_open'] = '<li class="waves-effect">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = "Last";
        $config['last_tag_open'] = '<li class="waves-effect">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = "&raquo";
        $config['next_tag_open'] = '<li class="waves-effect">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = "&laquo";
        $config['prev_tag_open'] = '<li class="waves-effect">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="#!">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="waves-effect">';
        $config['num_tag_close'] = '</li>';

        if ($this->input->get('submit', true)) {
            $data['keywords'] = $this->input->get('keywords', true);
            $this->session->set_userdata('keywords', $data['keywords']);
        } else {
            $data['keywords']  = $this->session->userdata('keywords');
        }

        $config['total_rows'] = $this->post_model->countSearch($data['keywords']);
        $data['total_rows'] = $this->post_model->countSearch($data['keywords']);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        // $this->load->view('projekpip/home', $data);
        $data['posts'] = $this->post_model->getPosts($config['per_page'], $page, $data['keywords']);

        $this->pagination->initialize($config);

        $this->load->view('projekpip/home', $data);
    }

    function test()
    {

        $data['posts'] = $this->post_model->test();
        $this->load->view('testong/test', $data);
    }

    public function form()
    {
        $this->load->view('projekpip/newpost');
    }

    public function loginInit()
    {
        $this->load->view('projekpip/login');
    }

    public function registerInit()
    {
        $this->load->view('projekpip/register');
    }

    public function registerAuth()
    {
        $errors = array();      // array to hold validation errors
        $data = array();      // array to pass back data

        // $salt = "saltysplatoon";
        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

        $userIp = $this->input->ip_address();
        $secret = $this->config->item('google_secret');
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $status = json_decode($output, true);

        if ($status['success']) {
            if (!empty($errors)) {
                $data['success'] = false;
                $data['errors'] = $errors;
            } else {
                //angkatan 13-19
                $allowed  = array('13', '14', '15', '16', '17', '18', '19');

                if (in_array(substr($_POST['nim'], 0, 2), $allowed) || strlen($_POST['nim']) != 15) {
                    $isSuccess = false;

                    $postFields = array(
                        "status_loc" => "Geolocation is not supported by your browser",
                        "lat" => "",
                        "long" => "",
                        "username" => $_POST['nim'],
                        "password" => $_POST['password_siam'],
                        "login" => "Masuk"
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://siam.ub.ac.id/index.php");
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
                    curl_setopt($ch, CURLOPT_COOKIEJAR, "");
                    $response = curl_exec($ch);

                    curl_close($ch);
                    $html = new simple_html_dom();
                    $html->load($response);
                    $scrappednim = null;

                    if ($html->find('div[class="textgreen"] b', 0)) {

                        //if doi is TIF

                        $isTif = false;
                        $jurusan = $html->find('div[class=bio-info"] div', 3)->innertext;
                        if (strpos($jurusan, 'Teknik Informatika') !== false) {
                            $isTif = true;
                        }

                        if ($isTif) {
                            $scrappednim = $html->find('div[class="textgreen"] b', 0)->innertext;

                            $name = $html->find('div[class=bio-name"]', 0)->innertext;

                            $isDuplicate = $this->user_model->duplicateCheck($scrappednim);

                            if (!$isDuplicate) {
                                $userdata = array(
                                    'nama_lengkap' => $name,
                                    'nim' => $scrappednim,
                                    'github_name' => $this->input->post('github'),
                                    'created' => date("Y-m-d H:i:s"),
                                    'modified' => date("Y-m-d H:i:s")
                                );

                                $isSuccess = $this->user_model->input_data($userdata);

                                if ($isSuccess) {
                                    $this->session->set_userdata($userdata);
                                    $data['success'] = false;
                                    $data['message'] = "Berhasil Melakukakn Registrasi";
                                } else {
                                    $data['success'] = false;
                                    $data['message'] = "Error Inserting To Database";
                                }
                            } else {
                                $data['success'] = false;
                                $data['message'] = "Anda Sudah Melakukakn Registrasi";
                            }
                        } else {
                            $data['success'] = false;
                            $data['message'] = "Anda Bukan Dari Jurusan Teknik Informatika";
                        }
                    } else {
                        $data['success'] = false;
                        $data['message'] = "Password Salah";
                    }
                } else {
                    $data['success'] = false;
                    $data['message'] = "Only Angkatan 13-19";
                }
            }
        } else {
            $data['success'] = false;
            $data['message'] = 'Mohon lengkapi captcha';
        }

        // return all our data to an AJAX call
        echo json_encode($data);
    }

    public function loginAuth()
    {

        $errors = array();      // array to hold validation errors
        $data = array();      // array to pass back data

        // $salt = "saltysplatoon";

        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

        $userIp = $this->input->ip_address();
        $secret = $this->config->item('google_secret');
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $status = json_decode($output, true);

        if ($status['success']) {
            if (!empty($errors)) {

                // if there are items in our errors array, return those errors
                $data['success'] = false;
                $data['errors'] = $errors;
            } else {
                //angkatan 13-19
                $allowed  = array('13', '14', '15', '16', '17', '18', '19');

                if (in_array(substr($_POST['nim'], 0, 2), $allowed) || strlen($_POST['nim']) != 15) {

                    $isSuccess = false;

                    $postFields = array(
                        "status_loc" => "Geolocation is not supported by your browser",
                        "lat" => "",
                        "long" => "",
                        "username" => $_POST['nim'],
                        "password" => $_POST['password_siam'],
                        "login" => "Masuk"
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://siam.ub.ac.id/index.php");
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
                    curl_setopt($ch, CURLOPT_COOKIEJAR, "");
                    $response = curl_exec($ch);

                    curl_close($ch);
                    $html = new simple_html_dom();
                    $html->load($response);
                    $scrappednim = null;

                    //if nim exist that means login success

                    if ($html->find('div[class="textgreen"] b', 0)) {

                        //if doi is TIF

                        $isTif = false;
                        $jurusan = $html->find('div[class=bio-info"] div', 3)->innertext;
                        if (strpos($jurusan, 'Teknik Informatika') !== false) {
                            $isTif = true;
                        }

                        if ($isTif) {
                            $scrappednim = $html->find('div[class="textgreen"] b', 0)->innertext;

                            $name = $html->find('div[class=bio-name"]', 0)->innertext;

                            $udahAda = $this->user_model->duplicateCheck($scrappednim);

                            if ($udahAda) {

                                $isSuccess = $this->user_model->getByNim($scrappednim);
                                $userdata = array(
                                    'nama_lengkap' => $name,
                                    'nim' => $scrappednim,
                                    'github_name' => $isSuccess->github_name,
                                    'created' => $isSuccess->created,
                                    'modified' => $isSuccess->modified
                                );

                                if ($isSuccess) {
                                    $this->session->set_userdata($userdata);
                                    $data['success'] = true;
                                    $data['message'] = "Berhasil Melakukakn Registrasi";
                                } else {
                                    $data['success'] = false;
                                    $data['message'] = "Error Creating Session";
                                }
                            } else {
                                $data['success'] = false;
                                $data['message'] = "Anda Belum Melakukakn Registrasi";
                            }
                        } else {
                            $data['success'] = false;
                            $data['message'] = "Anda Bukan Dari Jurusan Teknik Informatika";
                        }
                    } else {
                        $data['success'] = false;
                        $data['message'] = "Password Salah";
                    }
                } else {
                    $data['success'] = false;
                    $data['message'] = "Not Authorized to do Pemilwa";
                }
            }
        } else {
            $data['success'] = false;
            $data['message'] = 'Mohon lengkapi captcha';
        }



        echo json_encode($data);
    }

    public function logoutAuth()
    {
        $user_data = $this->session->userdata('nim');

        if ($user_data !== null) {
            $this->session->sess_destroy();
            //pakaikan redirect
            redirect(base_url('projekpip'));
        }
        redirect(base_url('projekpip'));
    }

    public function newPost()
    {
        if ($this->session->userdata('nim')) {
            $this->load->view('projekpip/newpost');
        } else {
            $this->load->view('projekpip/home');
        }
    }

    public function reqNewPost()
    {
        $errors = array();      // array to hold validation errors
        $data = array();      // array to pass back data

        if ($this->session->userdata('nim')) {

            if (!empty($errors)) {
                $data['success'] = false;
                $data['message'] = "Ada Error";
            } else {
                $nama_repo = $this->input->post('repo_name');
                $description = $this->input->post('description');

                $isSuccess = false;

                $postdata = array(
                    'github_name' => $this->session->userdata('github_name'),
                    'nama_repo' => $nama_repo,
                    'description' => $description,
                    'created' => date("Y-m-d H:i:s"),
                    'modified' => date("Y-m-d H:i:s")
                );

                $isSuccess = $this->post_model->input_data($postdata);

                if ($isSuccess) {
                    $data['success'] = true;
                    $data['message'] = "Berhasil Membuat POst";
                } else {
                    $data['success'] = false;
                    $data['message'] = "Error Sinkronasi Database";
                }
            }
        } else {
            $data['success'] = false;
            $data['message'] = "Desert Road, Desert Pain, I have seen so much pain";
        }


        echo json_encode($data);
    }
}
