<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    public function __construct() {
                parent::__construct();
                if (empty($this->session->userdata('userid')))
                        redirect('login');
        $this->load->model('orders_model');
}
        public function index(){
                $limit = 5;
                if ($this->input->get('start') and $this->input->get('start')>0){
                        $start = $this->input->get('start');
                }
                else
                        $start = 0;
                if ($this->input->get('search')){
                        $search = strtolower($this->input->get('search'));
                }
                else
                        $search = "";
                $result = $this->orders_model->get_orders_desc($search, $limit, $start);
                $count = $this->orders_model->get_orders_count($search)[0]->count;
//                $uzstotal = $this->orders_model->get_orders_total($search, 1);
//                if ($uzstotal)
//                        $uzstotal=$uzstotal[0];
//                else
//                        $uzstotal=null;
                
//                $cnytotal = $this->orders_model->get_orders_total($search, 0);
//                if ($cnytotal)
//                        $cnytotal=$cnytotal[0];
//                else
//                        $cnytotal=null;
                $in = $this->session->flashdata('passwordchanged');
                $this->load->cabtemplate('orders', array("page"=>"orders", "data"=>$result, "count"=>$count, 
//                        "in"=>$in, "search"=>$search, "count"=>$count, "start"=>$start, "limit"=>$limit, "uzstotal"=>$uzstotal, "cnytotal"=>$cnytotal));
                        "in"=>$in, "search"=>$search, "count"=>$count, "start"=>$start, "limit"=>$limit));
        }
        public function redirecttoindex(){
                if ($this->input->get('search')){
                        $search = strtolower($this->input->get('search'));
                        redirect('orders?search='.$search);
                }
                else
                        redirect('orders');
        }
        
        private function getpost(){
                $pdata = json_decode(implode("", $_POST));
                $sqldata = array();
                foreach ($pdata as $p){
                        if ($p->value==true)
                                array_push($sqldata, $p->key);
                        }
                if ($sqldata){
                        $query = implode(" OR orders.id=", $sqldata);
                        $query = "orders.id=".$query;
                        return $query;
                }
                else {
                foreach ($pdata as $p)
                        array_push($sqldata, $p->key);
                $query = implode(" OR orders.id=", $sqldata);
                $query = "orders.id=".$query;
                return $query;
                }
        } 
        public function export(){
                $data = $this->orders_model->get_orders_export($this->getpost());
                header("Content-Type: application/xls");
                $filename = 'Bistrenkobot-'.date("Y-m-d-H-i-s").'.xls';
                header("Content-Disposition: attachment; filename=".$filename);
                header("Pragma: no-cache");
                header("Expires: 0");
                echo '<table border="1">';
                echo '<tr>
                <th>Mijoz telefoni</th>
                <th>Manzili</th>
                <th>Jami narxi</th>
                <th>Sana</th>
                <th>Yuborildimi?</th>
                </tr>';
                foreach($data as $item){
                        echo '<tr>';
                        echo '<td>'.$item->phone.'</a></td>';
                        echo '<td>'.$item->orientation.'</a></td>';
                        echo '<td>'.number_format(intval($item->price/100), 0, ',', ' ').'</a></td>';
                        echo '<td>'.$item->date.'</a></td>';
                        if ($item->status==-2){
                                $s = '<p class="text-danger"><b>'."Bekor qilindi".'</b></p>';
                        }
                        else if ($item->status==0){
                                $s = '<p class="text-muted"><b>'."Yo'q".'</b></p>';
                        }
                        else if ($item->status==-1){
                                $s = '<p class="text-warning"><b>'."Ishlanmoqda".'</b></p>';
                        }
                        else if ($item->status==1){
                                $s = '<p class="text-success"><b>'."Ha".'</b></p>';
                        }
                        echo '<td>'.$s.'</td>';
                        echo '</tr>';
                }
                echo '</table>';
        }
        public function deletemarked(){
                $this->orders_model->delete_orders_marked($this->getpost());       
                $this->redirecttoindex();
        }
        private function sendmessage($id, $uztext, $rutext){
                $user = $this->orders_model->get_order_user_id($id)[0];
                $user_id = $user->uid;
                $user_lang = $user->lang;
                $user_trans_id = $user->transaction_id;
                if ($user_lang =="0"){
                        $text = $uztext;
                }
                else if ($user_lang =="1"){
                        $text = $rutext;
                }
                $text = $text.'<b>'.$user_trans_id.'</b>';
                $command = 'python3 '.$this->config->item('telegram_sender_location').' '.$user_id.' "'.$text.'"';
                shell_exec($command);
                $this->session->set_flashdata('saveordered',1);
                $this->redirecttoindex();
        }
        public function setordered(){
                $id = $this->input->get('id');
                $result = $this->orders_model->set_ordered($id);
                if ($result){
                        $uztext = "O'tkazmangiz muvaffaqiyatli o'tkazildi: ";
                        $rutext = "Ваша транзакция успешно произведена: ";
                        $this->sendmessage($id, $uztext, $rutext);
                }
        }
        public function onorder(){
                $id = $this->input->get('id');
                $result = $this->orders_model->on_order($id);
                if ($result){
                        $uztext = "O'tkazmangiz ishlanish jarayonida: ";
                        $rutext = "Ваша транзакция в обработке: ";
                        $this->sendmessage($id, $uztext, $rutext);
                }
        }
        public function cancelorder(){
                $id = $this->input->get('id');
                $result = $this->orders_model->cancel_order($id);
                if ($result){
                        $uztext = "O'tkazmangiz bekor qilindi: ";
                        $rutext = "Ваша транзакция была отменена: ";
                        $this->sendmessage($id, $uztext, $rutext);
                }
        }

        public function vieworder(){
                $id = $this->input->get('id');
                $result = $this->orders_model->get_order_desc($id);
                $products = $this->orders_model->get_products_in_orders_desc($id);

                $this->load->cabtemplate('vieworder', array("page"=>"vieworder", "data"=>$result, 'id'=>$id, "products"=>$products));
        }

        public function deleteorder(){
                if (hasadminrights()){
                        $id = $this->input->get('id');
                        $this->orders_model->delete_order($id);
                        $this->redirecttoindex();
                }
        }
}
