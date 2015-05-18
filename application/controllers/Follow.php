<?php
class Follow extends CI_Controller{
	public function detail()
	{
		$this->load->model('Follow_m');
		$data['streaminfo']=$this->Follow_m->detail();
		
	
		$dad=$this->Follow_m->follow_showpin();
		$data['pininfo']=$dad['pin'];
		$data['taginfo']=$dad['taginfo'];
		
		
		$this->load->view('Follow_detail',$data);
	}
   
	public function create()
	{
		$this->load->view('Follow_create_stream');
		if ( $this->input->post( 'create' ) ) {
          	 $data=array(
					'streamname'=>$_POST['stream-name'],
					'username'=>$_COOKIE['user']
					
		
			);
			$this->load->model('Follow_m');
			$this->Follow_m->create($data);
			redirect('follow/detail');
		}
	}
	public function createfollow($boardid,$streamid)
	{
		if ( $this->input->post( 'create' ) ) {
			$data=array(

					'streamid'=>$streamid,
					'boardid'=>$boardid,
						
	
			);
			$this->load->model('Follow_m');
			$this->Follow_m->createfollow($data);
			echo "follow success";
			redirect('follow/detail');
		}
	}
	public function showboard($streamid)
	{
		$this->load->model('Follow_m');
		$info=$this->Follow_m->showboard($streamid);
			$data['boardinfo']=$info['allboard'];
			$data['allinfo']=$info['allinfo'];
			$data['stream_id']=$streamid;
			$data['streaminfo']=$this->Follow_m->detail();
		
		
		$this->load->view('Follow_showboard',$data);

	}
	public function followboard($board_id)
	{
		$board_id=intval($board_id);
		$this->load->model('Follow_m');
		$data['streaminfo']=$this->Follow_m->detail();
		$data['boardid']=$board_id;
		$this->load->view('Follow_choose_stream',$data);
	}
	public function unfollow($streamid,$board_id)
	{
		$this->load->model('Follow_m');
        $this->Follow_m->unfollow($streamid,$board_id);
        echo 'unfollow success!!!';
	}
	
	
}