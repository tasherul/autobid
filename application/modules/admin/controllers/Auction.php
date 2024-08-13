<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Carbiz memento Controller
 *
 * This class handles memento management related functionality
 *
 * @package		Admin
 * @subpackage	car
 * @author		webhelios
 * @link		http://webhelios.com
 */

class Auction extends CI_Controller
{
    var $per_page = 10;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('content_model');
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
    }

    public function auction_add($auction_id = 0)
    {
        if ($this->user_type == 3) {
            redirect(site_url('admin/auction/bid_products'));
            die;
        }
        if ($this->input->post()) {
            $input = $this->input->post();
            $auction_id = $this->input->post('auction_id');
            $insert_data = [
                'car_id' =>  $input['car_id'],
                'asking_bid' =>  isset($input['asking_bid']) ? $input['asking_bid'] : 0,
                'min_bid' =>  isset($input['min_bid']) ? $input['min_bid'] : 0,
                'start_time' =>  $input['start_time'],
                'end_time' =>  $input['end_time'],
            ];
            if ($auction_id == 0) {
                $this->db->insert('auction', $insert_data);
            } else {
                $this->db->where('auction_id', $auction_id)->update('auction', $insert_data);
            }
            $this->db->where('id', $input['car_id'])->update('posts', ['is_auction' => 1]);
            redirect(site_url('admin/auction/auction_pending'));
            // redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($auction_id == 0) {
                $this->db->where('is_auction', 0);
            } else {
                $this->db->where('is_auction', 1);
            }
            if ($this->user_type != 1) {
                $this->db->where('created_by', $this->user_id);
            }
            $posts = $this->db->get('db_tabprefixposts')->result();
            $value                 = array();
            if ($auction_id != 0) {
                $auction = $this->db->get_where('auction', ['auction_id' => $auction_id])->row();
                $value['auction'] = $auction;
            }
            $data['title']         = lang_key('Auction Add');
            $value['posts']         = $posts;
            $value['user_type']    = $this->user_type;
            $value['auction_id']         = $auction_id;
            $data['content']     = load_admin_view('content/auction_add.php', $value, TRUE);
            load_admin_view('template/template_view', $data);
        }
    }

    public function change_auction_status()
    {
        $auction_status = $this->input->post('auction_status');
        $auction_id = $this->input->post('auction_id');

        $this->db->where('auction_id', $auction_id)->update('auction', ['auction_status' => $auction_status]);

        if ($auction_status == '0') {
            $href = site_url('admin/auction/auction_pending');
        } elseif ($auction_status == 1) {
            $href = site_url('admin/auction/auction_approved');
        } else {
            $href = site_url('admin/auction/auction_close');
        }
        echo json_encode($href);
    }

    public function auction_approved()
    {
        if ($this->user_type == 3) {
            redirect(site_url('admin/auction/bid_products'));
            die;
        }
        $value                 = array();
        $value['user_type']    = $this->user_type;
        $data['title']         = lang_key('Approved Auctions');
        $data['content']     = load_admin_view('content/auction_approved.php', $value, TRUE);
        load_admin_view('template/template_view', $data);
    }

    public function auction_pending()
    {
        if ($this->user_type == 3) {
            redirect(site_url('admin/auction/bid_products'));
            die;
        }
        $auctions = $this->db->get('auction')->result();
        $value                 = array();
        $value['auctions'] = $auctions;
        $value['user_type']    = $this->user_type;
        $data['title']         = lang_key('Pending Auctions');
        $data['content']     = load_admin_view('content/auction_pending.php', $value, TRUE);
        load_admin_view('template/template_view', $data);
    }
    public function auction_pending_ajax_view($start = '0', $status = 0)
    {
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->db->select('posts.*,  auction.*');
        $this->db->join('posts', 'posts.id=auction.car_id');
        $this->db->where('auction_status', $status);
        $this->db->where('posts.is_auction', 1);
        if ($user_type != 1) {
            $this->db->where('posts.created_by', $user_id);
        }
        $auctions = $this->db->get('auction')->result();
        $value['auctions'] = $auctions;
        $value['user_type'] = $user_type;
        $value['i'] = $start + 1;        //added on version 1.9
        $value['pages']        = configPagination('admin/content/auction_pending_ajax_view.php', count($auctions), 5, $this->per_page);
        load_admin_view('content/auction_pending_ajax_view', $value);
    }


    public function auction_close()
    {
        if ($this->user_type == 3) {
            redirect(site_url('admin/auction/bid_products'));
            die;
        }
        $value                 = array();
        $value['user_type']    = $this->user_type;
        $data['title']         = lang_key('Closes Auctions');
        $data['content']     = load_admin_view('content/auction_close.php', $value, TRUE);
        load_admin_view('template/template_view', $data);
    }


    public function bid_products()
    {
        if ($this->user_type == 2) {
            redirect(site_url('admin/auction/auction_pending'));
            die;
        }
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');

        $this->db->select('posts.title, posts.id,  bid.*, auction.*');

        if ($user_type != 1) {
            $this->db->where('bid.user_id', $user_id);
        }
        $this->db->where('bid.status', 0);
        $this->db->join('posts', 'posts.id = bid.car_id');
        $this->db->join('auction', 'auction.auction_id = bid.car_id');
        $bids = $this->db->get('bid')->result();
        $value                 = array();
        $value['bids']         = $bids;
        $value['user_type']         = $user_type;
        $data['title']         = lang_key('Bidded Products');
        $data['content']     = load_admin_view('content/bid_products.php', $value, TRUE);
        load_admin_view('template/template_view', $data);
    }


    public function purchase_history()
    {
        if ($this->user_type == 2) {
            redirect(site_url('admin/auction/auction_pending'));
            die;
        }
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');

        $this->db->select('posts.title, posts.id,  bid.*, auction.*');

        if ($user_type != 1) {
            $this->db->where('bid.user_id', $user_id);
        }
        $this->db->where('bid.status', 1);
        $this->db->join('posts', 'posts.id = bid.car_id');
        $this->db->join('auction', 'auction.auction_id = bid.car_id');
        $bids = $this->db->get('bid')->result();
        $value                 = array();
        $value['bids']         = $bids;
        $value['user_type']         = $user_type;
        $data['title']         = lang_key('Purchase History');
        $data['content']     = load_admin_view('content/purchase_history.php', $value, TRUE);
        load_admin_view('template/template_view', $data);
    }

    public function purchase_status_update()
    {
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        $name = $this->input->post('name');

        $this->db->where('bid_id', $id)->update('bid', [$name => $value]);

        echo json_encode('reload');
    }

    public function edit_bid()
    {
        $bid_id = $this->input->post('bid_id');
        $amount = $this->input->post('amount');

        $this->db->where('bid_id', $bid_id)->update('bid', ['amount' => $amount]);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function add_bid()
    {
        $car_id = $this->input->post('car_id');
        $auction_id = $this->input->post('auction_id');
        $amount = $this->input->post('amount');

        $has_bid = $this->db->get_where('bid', ['user_id' => $this->user_id, 'car_id' => $car_id])->row();
        if (!empty($has_bid)) {
            $this->db->where('bid_id', $has_bid->bid_id)->update('bid', ['amount' => $amount]);
        } else {
            $data = [
                'car_id' => $car_id,
                'auction_id' => $auction_id,
                'amount' => $amount,
                'user_id' => $this->user_id,
            ];
            $this->db->insert('bid', $data);
        }


        redirect($_SERVER['HTTP_REFERER']);
    }
}
