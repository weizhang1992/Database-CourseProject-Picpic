<?php
class Account extends CI_Controller{
	public function index()
	{
		echo 'hello';
	}
	
	public function login()
	{
	
		$this->load->view('Account_login');
		
		if ( isset($_POST['create'])) {
			$data=array(
					'username'=>$_POST['user-name'],
					'pw_encode'=>sha1($_POST['pass-word'])
		
			);
			
			$this->load->model('Account_m');
			
			if($this->Account_m->login($data)){
				
				$this->input->set_cookie("user", $data['username'], time()+3600);
			    redirect('/picpic');
		    }
		    else echo 'wrong password or username';
	}
	}
	
	public function signup()
	{
		
		$this->load->view('Account_signup');
		if ( isset($_POST['create'] )) {
			$data=array(
				'username'=>$_POST['user-name'],
				'firstname'=>$_POST['first-name'],
				'lastname'=>$_POST['last-name'],
				'email'=>$_POST['e-mail'],
				'password'=>$_POST['pass-word'],
			    'pw_encode'=>sha1($_POST['pass-word'])

			);
			$this->load->model('Account_m');
			$this->Account_m->signup($data);
			$this->input->set_cookie("user", $data['username'], time()+3600);
	    redirect('account/detail');
	  }
	}
	
	public function update()
	{
		if ( $this->input->post( 'create' ) ) {
			$data=array(
					'username'=>$_POST['user-name'],
					'firstname'=>$_POST['first-name'],
					'lastname'=>$_POST['last-name'],
					'email'=>$_POST['e-mail'],
					'password'=>$_POST['pass-word'],
					'pw_encode'=>sha1($_POST['pass-word'])
			);
			$this->load->model('Account_m');
			$this->Account_m->update($data);
			redirect('account/detail');
		}
		$this->load->model('Account_m');
		$data['userinfo']=$this->Account_m->detail();
		$this->load->view('Account_update',$data);
	}
	
	public function logoff()
	{
		echo 'good bye';
	}
	
	public function detail()
	{
		$this->load->model('Account_m');
		
		$data['userinfo']=$this->Account_m->detail();
		$this->load->view('Account_detail',$data);
	}
	
	public function like()
	{
		$this->load->model('Account_m');
		$data['userlike']=$this->Account_m->userlike();
		$this->load->view('Account_like',$data);
	}
	
	
}