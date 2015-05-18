<?php
class Account_m extends CI_Model {

	public $title;
	public $content;
	public $date;

	

	public function login($data)
	{
		$query_str = "SELECT username FROM userinfo WHERE username = ? and pw_encode = ?";
		$result = $this->db->query($query_str, array($data['username'], $data['pw_encode']));
		if ($result->num_rows() ==1)
		{
			
			return $result->row(0)->username;
		}
		else
		{
			return false;
		}
	}

	public function signup($info)
	{
		
		$this->db->insert('userinfo', $info);
	}

	public function update($info)
	{
		

		$this->db->update('userinfo', $info, array('username'=>$_COOKIE['user']));
	}
	public function detail()
	{
		$query_str = "SELECT * FROM userinfo WHERE username = ?";
		
		
			return $this->db->query($query_str, $_COOKIE['user'])->row_array();
		
	}

}