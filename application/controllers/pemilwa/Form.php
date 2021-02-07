<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pemilwa/epemilwa', 'model_pemilwa');
        $this->load->model('pemilwa/reg_pemilwa', 'model_reg');
        include('simple_html_dom.php');
    }

    public function register()
    {
        $data['status'] = FALSE;
        //$this->form_validation->set_rules('nim', 'Nim', 'required|exact_length[15]|callback_nim_check');
        $this->parser->parse('pemilwa/form_regsiter_marvel', $data);
    }

    public function init_pemilwa()
    {

        $now = strtotime(date("Y-m-d"));
        $dday = strtotime("2021-02-07");
        if ($now == $dday) {

            $hour = strtotime(date("H:i"));
            $starthour = strtotime("02:00");
            $endhour = strtotime("10:00");

            if ($hour <= $starthour) {
                $remain = date("H:i", $starthour - $hour);
            } else if ($hour >= $endhour) {
                $remain = date("H:i", $hour - $endhour);
            }

            if ($hour >= $starthour && $hour <= $endhour) {
                $data['status'] = FALSE;

                $data['livecount'] = $this->model_pemilwa->liveCount();
                $this->parser->parse('pemilwa/form_login', $data);
            } else {
                if ($remain >= $endhour) {
                    echo "Pemilwa Sudah Selesai";
                } else {
                    echo "Pemilwa Dimulai ";
                    echo $remain;
                    echo " Jam Lagi.";
                }
            }
        } else {
            echo 'Maaf, Pemilwa ditutup.';
        }

        // $data['status'] = FALSE;

        // $data['livecount'] = $this->model_pemilwa->liveCount();
        // // echo $this->session->userdata('cry');
        // //$this->form_validation->set_rules('nim', 'Nim', 'required|exact_length[15]|callback_nim_check');
        // $this->parser->parse('pemilwa/form_login', $data);
        // // echo CI_VERSION;
    }

    public function register_pemilwa()
    {
        $errors = array();      // array to hold validation errors
        $data = array();      // array to pass back data

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

            $uploadFileSuccess = false;

            if ($_FILES['foto']['size'] > 3145728) {
                $data['message'] = "Ukuran file melebihi batas maksimal (3MB).";
            } else {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 3000;
                // $config['max_width'] = 1500;
                // $config['max_height'] = 1500;

                //$this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('foto')) {
                    $error = $this->upload->display_errors();
                    $data['message'] = $error;
                } else {
                    $uploadFileSuccess = true;
                }
            }

            $isSuccess = false;



            // if there are any errors in our errors array, return a success boolean of false
            if (!empty($errors)) {

                // if there are items in our errors array, return those errors
                $data['success'] = false;
                $data['errors'] = $errors;
            } else {

                // if there are no errors process our form, then return a message
                // $isSuccess = $this->m_data->input_data($data_pass);

                $data_pass = array(
                    "nama_lengkap" => $_POST['nama_lengkap'],
                    "nim" => $_POST['nim'],
                    "kontak" => $_POST['kontak'],
                    "nomor" => $_POST['nomor'],
                    "alasan" => $_POST['alasan_1']
                );

                $isSuccess = $this->model_reg->input_data($data_pass);
                // DO ALL YOUR FORM PROCESSING HERE
                // THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)

                // show a message of success and provide a true success variable
                if ($isSuccess) {
                    $data['success'] = true;
                    $data['message'] = 'Registrasi berhasil!';
                } else {
                    $data['success'] = false;
                    $data['errors'] = $errors;
                }
            }
        } else {
            $data['success'] = false;
            $data['message'] = 'Mohon lengkapi captcha';
        }

        // return all our data to an AJAX call
        echo json_encode($data);
    }


    public function login_pemilwa()
    {

        log_message("info", "Masuk Login Pemilwa");

        $errors = array();      // array to hold validation errors
        $data = array();      // array to pass back data

        $sallydontgo = "saltysplatoon";

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
        // $status['success'] = true;
        if ($status['success']) {

            log_message("info", "Berhasil Captcha");

            // var_dump($data_pass);

            // $postFields = array('status_loc' => 'Geolocation is not supported by your browser', 'lat' => '', 'long' => '', 'username' => $data_pass['nim'], 'password' => $data_pass['password'], 'login' => 'Masuk',);
            // $postFields = array('status_loc' => 'Geolocation is not supported by your browser', 'lat' => '', 'long' => '', 'username' => '17515020711106', 'password' => '1Slamulanadinan', 'login' => 'Masuk',);


            // if there are any errors in our errors array, return a success boolean of false
            if (!empty($errors)) {

                // if there are items in our errors array, return those errors
                $data['success'] = false;
                $data['errors'] = $errors;
            } else {
                //angkatan 13-19
                $allowed  = array('13', '14', '15', '16', '17', '18', '19');

                if (in_array(substr($_POST['nim'], 0, 2), $allowed) || strlen($_POST['nim']) != 15) {

                    $redirectkey = "empty";
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

                    if (curl_errno($ch)) {
                        log_message("error", $ch);
                    } else {
                        log_message("debug", "CURL Berhasil");
                    }

                    curl_close($ch);
                    $html = new simple_html_dom();
                    $html->load($response);
                    $scrappednim = null;

                    //if nim exist that means login success

                    if ($html->find('div[class="textgreen"] b', 0)) {

                        //if doi is TIF
                        log_message("info", "Berhasil CURL ke SIAM");
                        $isTif = false;
                        $jurusan = $html->find('div[class=bio-info"] div', 3)->innertext;
                        if (strpos($jurusan, 'Teknik Informatika') !== false) {
                            $isTif = true;
                        }

                        if ($isTif) {
                            $scrappednim = $html->find('div[class="textgreen"] b', 0)->innertext;
                            // $md5nim = md5($scrappednim);
                            // $sh1nim = sha1($md5nim);
                            // $cryptnim  = crypt($sh1nim, $sallydontgo);
                            $name = $html->find('div[class=bio-name"]', 0)->innertext;

                            // $isSuccess = $this->model_pemilwa->duplicateCheck($cryptnim);
                            $isSuccess = $this->model_pemilwa->duplicateCheck($scrappednim);
                            // $redirectkey = $cryptnim;
                            if (!$isSuccess) {
                                $data_pass = array(
                                    'nama_lengkap'  => $name,
                                    'nim' => $scrappednim,
                                    'pilih' => 0,
                                    'keuze' => "optie"
                                );
                                $isSuccess = $this->model_pemilwa->input_data($data_pass);
                                // $redirectkey = $cryptnim;
                            }

                            // if there are no errors process our form, then return a message
                            // $isSuccess = $this->m_data->input_data($data_pass);


                            // DO ALL YOUR FORM PROCESSING HERE
                            // THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)

                            // show a message of success and provide a true success variable
                            if ($isSuccess) {

                                // $udahPilih = $this->model_pemilwa->udahPilih($cryptnim);
                                $udahPilih = $this->model_pemilwa->udahPilih($scrappednim);
                                if (!$udahPilih) {
                                    $userdata = array(
                                        'cry' => $scrappednim,
                                        'name' => $name
                                    );
                                    $this->session->set_userdata($userdata);

                                    // $this->session->set_userdata('cry', $cryptnim);
                                    //destroy with $this->session->sess_destroy();
                                    //check with isset($_SESSION['kanye'])

                                    $data['success'] = true;
                                    // $data['message'] = 'Wait for Redirect';
                                    $data['message'] = "SUCCESS, PLEASEEE WAIT FOR REDIRECT";
                                    // $data['redirectkey'] = $redirectkey;
                                    // redirect(base_url() . "pemilwa/test");
                                    log_message("debug", "form login sukses");
                                } else {
                                    $data['success'] = false;
                                    $data['message'] = "Anda sudah Memilih";
                                    log_message("debug", $scrappednim . " sudah memilih");
                                }
                            } else {
                                $data['success'] = false;
                                $data['errors'] = $errors;
                                log_message("error", "Somethings wrong with the models : " . $errors);
                            }
                        } else {
                            $data['success'] = false;
                            $data['message'] = "Anda Bukan Dari Jurusan Teknik Informatika";
                            log_message("debug", $scrappednim . " Not From TIF");
                        }
                    } else {
                        $data['success'] = false;
                        $data['message'] = "Password Salah";
                        log_message("error", "Tidak Berhasil CURL ke SIAM");
                    }
                } else {
                    $data['success'] = false;
                    $data['message'] = "Not Authorized to do Pemilwa";
                    log_message("debug", "NIM is not in the correct format");
                }
            }
        } else {
            $data['success'] = false;
            $data['message'] = 'Mohon lengkapi captcha';
        }

        // return all our data to an AJAX call
        echo json_encode($data);
    }

    public function test()
    {

        // $postFields = array('status_loc' => 'Geolocation is not supported by your browser', 'lat' => '', 'long' => '', 'username' => '175150207111016', 'password' => '1Slamulanadinan', 'login' => 'Masuk',);
        // $sallydontgo = "saltysplatoon";

        // $postFields = array(
        //     "status_loc" => "Geolocation is not supported by your browser",
        //     "lat" => "long",
        //     "long" => "",
        //     "username" => "NIM",
        //     "password" => "Password",
        //     "login" => "Masuk"
        // );

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "https://siam.ub.ac.id/index.php");
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla');
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        // curl_setopt($ch, CURLOPT_COOKIEJAR, "wontworkwithoutthis");
        // $response = curl_exec($ch);



        // curl_close($ch);
        // $html = new simple_html_dom();
        // $html->load($response);
        // $scrappednim = "NIM";
        // $md5nim = md5($scrappednim);
        // $sh1nim = sha1($md5nim);
        // $cryptnim  = crypt($sh1nim, $sallydontgo);
        // echo $cryptnim;



    }
}
