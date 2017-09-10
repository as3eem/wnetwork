<?php
/**
 * Created by PhpStorm.
 * User: coder
 * Date: 7/9/17
 * Time: 3:31 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    function index()
    {
        echo 'transferred';
    }

    function signup_process()
    {
//        $submit = $this->input->post('register', TRUE);
//        if ($submit == 'Register') {
        $this->load->model('Db_model');
        $data = $this->_fetch_data_from_post();
        $this->_insert($data);
        redirect(base_url("index.php/user/dashboard"));

    }
    function requestHandle()
    {
////        $forID=define;
//        $this->recHandle($forID);
//        $this->sendHandle();


        $this->load->model('Db_model');
        $query = $this->Db_model->get('EMAIL');
        foreach ($query->result() as $row)
        {
            $data['id'] = $row->id;
        }
        echo 'wow';
        echo '<br>';
        print_r($data);
        die;

    }
    function recHandle($forID)
    {
        $this->load->model('Db_model');
        $usr = $this->session->userdata('username');
//        $send = "select * from userdata where EMAIL = '" . $usr;
        $rec = "select * from userdata where EMAIL = '" . $forID;
        $rec = $this->Db_model->_custom_query($rec);
        return $rec->num_rows();

    }
    function sendHandle()
    {
        $this->load->model('Db_model');
        $usr = $this->session->userdata('username');
        $send = "select * from userdata where EMAIL = '" . $usr;
//        $rec = "select * from userdata where EMAIL = '" . $forID;
        $sender = $this->Db_model->_custom_query($send);
        return $sender->bum_rows();

    }
    function _req_check($usr, $pwd)
    {
        $this->load->model('Db_model');
        $query = "select * from userdata where EMAIL = '" . $usr . "' and PASSWORD = '" . $pwd . "' ";
        $query = $this->Db_model->_custom_query($query);
        return $query->num_rows();
    }

    function login()
    {

        $this->load->view('login');
    }
    ///////////////////////////////////////////////////
    ///
    ///
    ///
    function _fetch_data_from_post()
    {
        $data['EMAIL'] = $this->input->post('email', TRUE);
        $data['PASSWORD'] = $this->input->post('pwd', TRUE);
        $data['USERNAME'] = $this->input->post('username', TRUE);
//        $data['PASSWORD'] = hash('sha256',$this->input->post('pwd', TRUE).SALT);
        $data['name'] = $this->input->post('name', TRUE);
        $data['about'] = $this->input->post('about', TRUE);
        $data['working'] = $this->input->post('work',TRUE);
        $data['score'] = $this->input->post('score', TRUE);
        $data['experience'] = $this->input->post('exp', TRUE);
        return $data;
    }

    function _user_auth()
    {
        $user_login = $this->session->userdata('logged_in');
        if (!$user_login)
        {
            //$this->load->view('Admin_login');
            redirect(base_url('user'));
        }
    }

    function _update($id, $data)
    {
        if (!is_numeric($id))
        {
            die('Non-numeric variable!');
        }

        $this->load->model('Db_model');
        $this->Db_model->_update($id, $data);
    }

    function _insert($data)
    {
        $this->load->model('Db_model');
        $this->Db_model->_insert($data);
    }


    ///////////////////////////
    ///
    function loginCheck()
    {

        $username = $this->input->post('email', TRUE);
        $password = $this->input->post('pwd', TRUE);
        $submit = $this->input->post('login', TRUE);


        if ($submit == 'Login') {
            if (True) {
                //check if username and password is correct
                $usr_result = $this->_get_user($username, $password);

                if ($usr_result > 0) //active user record is present
                {
                    //set the session variables
                    $sessiondata = array(
                        'username' => $username,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($sessiondata);
                    redirect(base_url("index.php/user/dashboard"));
                } else {
                    echo $msg = "<h1 style='color: red'>OOOPS!!! </h1><h2>Invalid username and password!</h2>";
                    //$value = '<div class="alert alert-danger">' . $msg . '</div>';
                    //$this->session->set_flashdata('item', $value);
//                    redirect(base_url());
                }
            } else {
                $this->load->view('login');
            }
        }

    }

    function dashboard()
    {
        $user_login = $this->session->userdata('logged_in');
        $mailwa = $this->session->userdata('username');
        $user_data = $this->_user_details($mailwa);

        if ($user_login) {
            $this->load->view('user_panel', $user_data);
        } else {
            $this->load->view('signup');
        }
    }

    function _get_user($usr, $pwd)
    {
        $this->load->model('Db_model');
        $query = "select * from userdata where EMAIL = '" . $usr . "' and PASSWORD = '" . $pwd . "' ";
        $query = $this->Db_model->_custom_query($query);
        return $query->num_rows();
    }

    function _user_details($email)
    {
        $this->load->model('Db_model');
        $query = $this->Db_model->get('EMAIL');

        foreach ($query->result() as $row) {
            //DATA AND SCHEMA REQUIRED ACCORDINGLY

            $data['id'] = $row->id;
            $data['pwd'] = $row->PASSWORD;
            $data['email'] = $row->EMAIL;
            $data['work'] = $row->WORKING;
            $data['exp'] = $row->EXPERIENCE;
            $data['score'] = $row->SCORE;
            $data['name'] = $row->NAME;
            $data['usr'] = $row->USERNAME;
            $data['about'] = $row->ABOUT;
            $data['score'] = $row->SCORE;
            $data['parent']= $row->PARENT;
            $data['dauA']= $row->DAUA;
            $data['dauB']= $row->DAUB;


        }
        return $data;


/////////////////////
    }
}