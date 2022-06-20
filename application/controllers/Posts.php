<?php // Interface between view and model
class Posts extends CI_Controller
{
    public function index($offset = 0) // Build of index
    {
        // Pagination config
        $config['base_url'] = base_url() . 'posts/index/';
        $config['total_rows'] = $this->db->count_all('posts');
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        // Init Pagination
        $this->pagination->initialize($config);

        // Structure of site
        $data['title'] = 'Latest Posts';
        $data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);
        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL) // Build of view
    {

        // Show posts with comments
        $data['post'] = $this->post_model->get_posts($slug);
        $post_id = $data['post']['id'];
        $data['comments'] = $this->comment_model->get_comments($post_id);

        if (empty($data['post'])) { // When post not found
            show_404();
        }

        // Structure of site
        $data['title'] = $data['post']['title'];
        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');
    }

    public function create() // Build of create post
    {
        // Check permission
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // Fields of input
        $data['title'] = 'Create Post';
        $data['categories'] = $this->post_model->get_categories();
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        // Structure of site
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('posts/create', $data);
            $this->load->view('templates/footer');
        } else {
            // Upload image
            $config['upload_path'] = './assets/images/posts';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '4096';
            $config['max_width'] = '4000';
            $config['max_height'] = '4000';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) { // Image incorrect
                $errors = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.jpg';
            } else { // Image correct
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $this->post_model->create_post($post_image);

            // Set message when successfully created pots
            $this->session->set_flashdata('post_created', 'Your Post has been created!');
            redirect('posts');
        }
    }
    public function delete($id) // Delete post
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->post_model->delete_post($id);

        // Set message when successfully deleted post
        $this->session->set_flashdata('post_deleted', 'Your post has been deleted!');

        redirect('posts');
    }

    public function edit($slug) // Edit post
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['post'] = $this->post_model->get_posts($slug);

        // Check permission
        if ($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']) {
            redirect('posts');
        }

        if (empty($data['post'])) { // When post not found
            show_404();
        }

        // Structure of site
        $data['title'] = 'Edit Post';
        $data['categories'] = $this->post_model->get_categories();
        $this->load->view('templates/header');
        $this->load->view('posts/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update() // Update post
    {
        // Check permission
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->post_model->update_post();

        // Set message when successfully updated post
        $this->session->set_flashdata('post_updated', 'Your post has been updated!');
        redirect('posts');
    }
}
