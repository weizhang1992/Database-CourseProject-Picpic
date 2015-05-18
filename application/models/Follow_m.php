
<?php
class Follow_m extends CI_Model {

	public $title;
	public $content;
	public $date;



	public function create($info)
	{
		$this->db->insert('followstream', $info);
	}
	
	public function createfollow($info)
	{
		$this->db->insert('boardfollow', $info);
	}
	
	public function unfollow($streamid,$boardid)
	{
		$query_str = "delete from boardfollow where streamid=? and boardid=?";
		return $this->db->query($query_str, array('streamid'=>$streamid,'boardid'=>$boardid));
	}
	

	public function detail()
	{
		$query_str = "SELECT * FROM followstream WHERE username= ?";
		return $this->db->query($query_str, $_COOKIE['user'])->result_array();
		

	}
	
	public function follow_showpin()
	{
		$query_str = "select * from pin p JOIN picture pc WHERE p.pictureid=pc.pictureid and p.boardid in (select boardid from boardfollow bf join followstream f  where bf.streamid=f.streamid and username=?) order by p.date_create DESC";
		$pinpin=$this->db->query($query_str, $_COOKIE['user'])->result_array();
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

	public function showboard($streamid)
	{
		$query_str = "SELECT * FROM board b join boardfollow bf WHERE b.status=1 and b.boardid=bf.boardid and bf.streamid=? order by b.data_create DESC";
		$allboard=$this->db->query($query_str,$streamid)->result_array();
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

	public function followboard()
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