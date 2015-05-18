<?php
class Pin extends CI_Controller{
	public function show($board_id,$pinid)
	{
		$this->load->model('Board_m');
		$this->load->model('Pin_m');
		
		$dad=$this->Pin_m->info($board_id,$pinid);
		
		$data['boardinfo']=$this->Board_m->boarddetail($board_id);
		$data['pininfo']=$dad['pin'];
		$data['taginfo']=$dad['taginfo'];
		
		$data['comment']=$this->Pin_m->showcomment($pinid);
		$data['likecount']=$this->Pin_m->likecount($pinid);

		
		$data['boardinfo']=$this->Board_m->boarddetail($board_id);
		$this->load->view('Pin_show',$data);

	}
	public function delete($pinid)
	{
		$this->load->model('Pin_m');
		$this->Pin_m->delete($pinid);
		echo 'delete success!!!';
	
	}
	
	
	
	public function search()
	{
		$this->load->model('Pin_m');
		if ( $this->input->post( 'create' ) ) {
		$keyword=$_POST['keyword'];
		$data['keyw']=$keyword;
		$dad=$this->Pin_m->search($keyword);
		$data['pininfo']=$dad['pin'];
		$data['taginfo']=$dad['taginfo'];
		$this->load->view('Pin_search',$data);
		}
		
		else {$this->load->view('Pin_search',$data);}
	}
	
	public function sort($keyw)
	{
		$this->load->model('Pin_m');
		$choose=$_POST['sortby'];
		if($_POST['sortby']=='relevance'){
			$data['keyw']=$keyw;
			$dad=$this->Pin_m->search($keyw);
			$data['pininfo']=$dad['pin'];
			$data['taginfo']=$dad['taginfo'];
		}
	    else if($_POST['sortby']=='time'){
	    	$data['keyw']=$keyw;
	    	$dad=$this->Pin_m->searchbytime($keyw);
	    	$data['pininfo']=$dad['pin'];
	    	$data['taginfo']=$dad['taginfo'];
	    }
	    else{
	    	$data['keyw']=$keyw;
	    	$dad=$this->Pin_m->searchbylikes($keyw);
	    	$data['pininfo']=$dad['pin'];
	    	$data['taginfo']=$dad['taginfo'];
	    }
	    $this->load->view('Pin_search',$data);
	}
	
	
	
	public function addcomment($boardid,$pinid)
	{
		$this->load->model('Pin_m');
		
					$dad=array(
							'username'=>$_COOKIE['user'],
							'pinid'=>$pinid,
							'content'=>$_POST['text']
					);
		$this->Pin_m->addcomment($dad);
		
		
        redirect('pin/show/'.$boardid.'/'.$pinid);
	
	}
	public function repin($pinid)
	{
		$this->load->model('Board_m');
		$d=$this->Board_m->detail();
		$data['boardinfo']=$d['allboard'];
	    $data['pinid']=$pinid;
	
		$this->load->view('Pin_repin_choose',$data);
	
	}
	
	public function create_repin($boardid,$from_pinid)
	{
	    if ( $this->input->post( 'create' ) ) {
	    	
	    	$this->load->model('Pin_m');
	    	$this->Pin_m->repin($boardid,$from_pinid);

		redirect('board/showpin/'.$boardid);
	  }
	}
	
	public function like($boardid,$pinid)
	{
		
		$this->load->model('Pin_m');
		$num=$this->Pin_m->likealready($pinid);
		if($num==0) {
			$this->Pin_m->likepin($pinid);
		}
		redirect('pin/show/'.$boardid.'/'.$pinid);
	
	}
	
	
	public function createbyupload($board_id)
	{
		$this->load->model('Board_m');
		$data['boardinfo']=$this->Board_m->boarddetail($board_id);
		$data['error']=' ';
		$this->load->view('Pin_createbyupload', $data);

	}
	public function createbyweb($board_id)
	{
		$this->load->model('Board_m');
		$data['boardinfo']=$this->Board_m->boarddetail($board_id);
		$this->load->view('Pin_createbyweb', $data, array('error' => ' ' ));
				if ( $this->input->post( 'create' ) ) {
					
					$url = $_POST['image-url'];
					$filename = substr($url, strrpos($url, '/') + 1);	
					file_put_contents('uploads/'.$filename, file_get_contents($url));
					
					
			        $picdata=array(
			        		'picture_url'=>$_POST['image-url']
			        );
			        
			        $tagname=array(
			        		'tagname1'=>$_POST['image-tag-1'],
			        		'tagname2'=>$_POST['image-tag-2'],
			        		'tagname3'=>$_POST['image-tag-3']	
			        );
			        
			        $para=array(
			        		'picdata'=>$picdata,
			        		'board_id'=>$board_id,
			        		'tagname'=>$tagname
			        );
					
					$this->load->model('Pin_m');
					$this->Pin_m->create($para);
					$add='board/showpin/'.$board_id;
					redirect($add);
					
	    }
	}
}