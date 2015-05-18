<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                $this->load->view('Pin_create', array('error' => ' ' ));
        }

        public function do_upload($boardid)
        {
        	    
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 10240;
                $config['max_height']           = 7680;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload())
                {
                        $error = array('error' => $this->upload->display_errors());
                        
                        $this->load->view('Pin_createbyupload', $error);
                }
                else
                {
                	
                        $data = array('upload_data' => $this->upload->data());
                        
                        $url = 'http://127.0.0.1/picpic/uploads/'.$data['upload_data']['file_name'];
  
                        	
                        	
                        $picdata=array(
                        		'picture_url'=>$url,
                        );
                         
                        $tagname=array(
                        		'tagname1'=>$_POST['image-tag-1'],
                        		'tagname2'=>$_POST['image-tag-2'],
                        		'tagname3'=>$_POST['image-tag-3']
                        );
                         
                        $para=array(
                        		'picdata'=>$picdata,
                        		'board_id'=>$boardid,
                        		'tagname'=>$tagname
                        );
                        	
                        $this->load->model('Pin_m');
                        $this->Pin_m->create($para);
                        $add='board/showpin/'.$boardid;
                        redirect($add);
                     
                }
        }
}
?>