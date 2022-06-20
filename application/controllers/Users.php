<?php // Interface between view and model
class Users extends CI_Controller
{
    public function register() // Register a new member
    {
        $data['title'] = 'Sign Up';

        // Fields of input
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Password2', 'matches[password]');

        // Structure of site
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');
        } else {
            // Encrypt password
            $enc_password = md5($this->input->post('password'));

            $this->user_model->register($enc_password);

            // Set message when successfully registered
            $this->session->set_flashdata('user_registered', 'You are now registered!');
            redirect('posts');
        }
    }

    // Log in user
    public function login()
    {
        $data['title'] = 'Sign In';

        // Fields of input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Structure of site
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {
            // Get username
            $username = $this->input->post('username');
            // Get and encrypt password
            $password = md5($this->input->post('password'));
            // Login user
            $user_id = $this->user_model->login($username, $password);

            if ($user_id) {
                // Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);

                // Set message when successfully logged in
                $this->session->set_flashdata('user_loggedin', 'You are now logged in!');

                redirect('posts');
            } else {
                // Set message when login failed
                $this->session->set_flashdata('login_failed', 'Login is invalid!');
                redirect('users/login');
            }
        }
    }

    // Log user out
    public function logout(){
        // Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        // Set message when successfulyy logged out
        $this->session->set_flashdata('user_loggedout', 'You are now logged out!');

        redirect('users/login');
    }

    // Check if username exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is already taken. Please choose a different one.');
        if ($this->user_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if email-adress already exists
    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'That email-adress is already taken. Please choose a different one.');
        if ($this->user_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }
}
