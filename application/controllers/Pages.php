<?php // Interface between view and model
class Pages extends CI_Controller
{
    public function view($page = 'home') // Structure of site
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) { // When site not found
            show_404();
        }

        $data['title'] = ucfirst($page);
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
    }
}
