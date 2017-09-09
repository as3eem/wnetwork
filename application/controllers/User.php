<?php
/**
 * Created by PhpStorm.
 * User: coder
 * Date: 7/9/17
 * Time: 3:31 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
        $submit = $this->input->post('register', TRUE);
        if ($submit == 'Register') {
            $this->load->model('Db_model');
            $data = $this->_fetch_data_from_post();
            $this->_insert($data);

        }
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
//        $data['phone_no'] = $this->input->post('phone_number', TRUE);
//        $data['email'] = $this->input->post('email',TRUE);
        return $data;
    }

    function _user_auth()
    {
        $user_login = $this->session->userdata('logged_in');
        if(!$user_login)
        {
            //$this->load->view('Admin_login');
            redirect(base_url('user'));
        }
    }
    function _update($id, $data)
    {
        if (!is_numeric($id)) {
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

        $username = $this->input->post('email',TRUE);
        $password = $this->input->post('pwd',TRUE);
        $submit = $this->input->post('login',TRUE);


        if($submit == 'Login')
        {
            if(True)
            {
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
                }
                else
                {
                    echo $msg = "<h1 style='color: red'>OOOPS!!! </h1><h2>Invalid username and password!</h2>";
                    //$value = '<div class="alert alert-danger">' . $msg . '</div>';
                    //$this->session->set_flashdata('item', $value);
//                    redirect(base_url());
                }
            }
            else
            {
                $this->load->view('login');
            }
        }

    }

    function dashboard()
    {
        $user_login = $this->session->userdata('logged_in');
        $mailwa=$this->session->userdata('username');
        $user_data=$this->_user_details($mailwa);

        if($user_login)
        {
            $this->load->view('user_panel',$user_data);
        }
        else
        {
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

        foreach($query->result() as $row)
        {
            //DATA AND SCHEMA REQUIRED ACCORDINGLY

                $data['id'] = $row->id;
//                $data['title'] = $row->username;
                $data['email'] = $row->EMAIL;
//                $data['work'] = $row->WORKING;
//                $data['exp'] = $row->EXPERIENCE;
//                $data['score'] = $row->SCORE;
                $data['name']= 'Aseem';
                $data['about']='If, however, the query can use an index but the query predicates do not access a single contiguous range of index 
                keys or the query also contains conditions on fields outside the index, then in addition to using the index, MongoDB must also 
                read the documents to return the count.
                If, however, the query can use an index but the query predicates do not access 
                a single contiguous range of index keys or the query also contains conditions on fields outside the index, then in addition to using the index, MongoDB 
                must also read the documents to return the count.';
        }
        return $data;
    }

/////////////////////
}
