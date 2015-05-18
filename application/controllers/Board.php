<?php
class Board extends CI_Controller{
	
	public function detail()
	{
		$this->load->model('Board_m');
		
		
		$info=$this->Board_m->detail();
		$data['boardinfo']=$info['allboard'];
		$data['allinfo']=$info['allinfo'];
		
		
		$this->load->view('Board_detail',$data);
		
	
	}
	public function create()
	{
		$status=2;
		$this->load->view('Board_create');
		if ( $this->input->post( 'create' ) ) {
			if($_POST['board-status']=='public') 
			{$status=1;}
			else if($_POST['board-status']=='friend-only') 
			{$status=0;}
			else
			{redirect('account/login');

			} 
			$data=array(
					'boardname'=>$_POST['board-name'],
					'board_user'=>$_COOKIE['user'],
					'status'=>$status,
					'description'=>$_POST['board-description']
					
		
			);
			$this->load->model('Board_m');
			$this->Board_m->create($data);
			redirect('board/detail');
		}
	}
	public function showpin($board_id)
	{
		
	    $board_id=intval($board_id);
		$this->load->model('Board_m');
		$data['boardinfo']=$this->Board_m->boarddetail($board_id);
	
		$dad=$this->Board_m->showpin($board_id);
		$data['pininfo']=$dad['pin'];
		$data['taginfo']=$dad['taginfo'];
		
		if($_COOKIE['user']==$data['boardinfo'][0]['board_user']){
			$this->load->view('Board_showpin',$data);
		}
		else {$this->load->view('Board_showpin_public',$data);}
	}
	
	
}