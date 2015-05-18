
<?php
class Board_m extends CI_Model {

	public $title;
	public $content;
	public $date;



	public function create($info)
	{
		$this->db->insert('board', $info);
	}

	public function update($info)
	{


		$this->db->update('userinfo', $info, array('username'=>$_COOKIE['user']));
	}
	public function detail()
	{
		$query_str = "SELECT * FROM board WHERE board_user=? order by data_create DESC";
		$allboard=$this->db->query($query_str,$_COOKIE['user'])->result_array();
		$allinfo=array();
		foreach ($allboard as $boarditem){
			$pin_query_str = "select *  from pin p join picture pc where p.pictureid=pc.pictureid and p.boardid= ? order by p.date_create DESC";
			$pinpic=$this->db->query($pin_query_str, $boarditem['boardid'])->result_array();
			 
			$allinfo[$boarditem['boardid']]=$pinpic;
		}
		$dad=array(
				'allboard'=>$allboard,
				'allinfo'=>$allinfo
		);
		
		return $dad;

	}
	public function showpin($id)
	{
		$query_str = "SELECT * FROM pin p JOIN picture pc WHERE p.pictureid=pc.pictureid and p.boardid= ? order by p.date_create ";
		$pinpin=$this->db->query($query_str, $id)->result_array();
		$taginfo=array();
        foreach ($pinpin as $pin){
        	$tag_query_str = "select tagname from pintag where pinid= ?";
        	$tag=$this->db->query($tag_query_str, $pin['pinid'])->result_array();
        	
        	$taginfo[$pin['pinid']]=$tag;
        }
        $dad=array(
        		'pin'=>$pinpin,
        		'taginfo'=>$taginfo
        );
		return $dad;
	
	}
	
	public function boarddetail($id)
	{
		$query_str = "SELECT * FROM board WHERE boardid= ?";
		return $this->db->query($query_str, $id)->result_array();
	}
	
	public function alldetail()
	{
		$query_str = "SELECT * FROM board WHERE status=1 order by data_create DESC";
		$allboard=$this->db->query($query_str)->result_array();
		$allinfo=array();
		foreach ($allboard as $boarditem){
			$pin_query_str = "select *  from pin p join picture pc where p.pictureid=pc.pictureid and p.boardid= ? order by p.date_create DESC";
			$pinpic=$this->db->query($pin_query_str, $boarditem['boardid'])->result_array();
			 
			$allinfo[$boarditem['boardid']]=$pinpic;
		}
		$dad=array(
				'allboard'=>$allboard,
				'allinfo'=>$allinfo
		);
		
		return $dad;
	
	}
	
	
	

}