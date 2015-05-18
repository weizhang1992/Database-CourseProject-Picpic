<?php
class Pin_m extends CI_Model {

	public $title;
	public $content;
	public $date;

	
	public function delete($pinid)
	{

		$pinid=(int)$pinid;
		$query_str1 = "delete from comment where pinid= ?";
		$this->db->query($query_str1, $pinid);
	
		$query_str2 = "delete from pintag where pinid= ?";
		$this->db->query($query_str2, $pinid);
		
		$query_str3 = "delete from userlike where pinid= ?";
		$this->db->query($query_str3, $pinid);
		
		$query_str4 = "delete from repin where from_pinid= ?";
		$this->db->query($query_str4, $pinid);
		
		$query_str5 = "delete from repin where to_pinid= ?";
		$this->db->query($query_str5, $pinid);
		
		$query_str = "delete from pin where pinid= ?";
		$this->db->query($query_str, $pinid);

	}

	public function info($boardid,$pinid)
	{
		$query_str = "SELECT * FROM pin p JOIN picture pc WHERE p.pictureid=pc.pictureid and p.pinid= ?";
		$pinpin=$this->db->query($query_str, $pinid)->result_array();
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
	
	public function addcomment($data)
	{
          $this->db->insert('comment', $data);
	}
	
	public function likecount($pinid)
	{
		$query_str="SELECT count(*) as likenum FROM userlike WHERE pinid = ?";
		return $this->db->query($query_str, $pinid)->result_array();
	}
	
	public function likepin($pinid)
	{
		$info=array(
				'username'=>$_COOKIE['user'],
				'pinid'=>$pinid
		);
		$this->db->insert('userlike', $info);
	}
	
	public function likealready($pinid)
	{
		$query_str="SELECT count(*) as likenum FROM userlike WHERE username = ? and pinid = ?";
		$info=array(
			'username'=>$_COOKIE['user'],
			'pinid'=>$pinid
		);
		$num=$this->db->query($query_str, $info)->result_array();
		return $num[0]['likenum'];
	}
	
	public function showcomment($pinid)
	{
		$query_str="SELECT * FROM comment WHERE pinid = ?";
		return $this->db->query($query_str, $pinid)->result_array();
	}

	public function create($picinfo)
	{
		
		$this->db->insert('picture', $picinfo['picdata']);
		$pic_query_str="SELECT pictureid FROM picture WHERE picture_url = ?";
		$pic_result=$this->db->query($pic_query_str, $picinfo['picdata']['picture_url'])->row_array(0);
		
		
		
		$pindata=array(
				'pictureid'=>$pic_result['pictureid'],
				 'boardid'=>$picinfo['board_id']
		);

		$this->db->insert('pin', $pindata);
		$pin_query_str="SELECT * FROM pin WHERE pictureid = ? and boardid=? ORDER BY pinid DESC";
		$pin_result=$this->db->query($pin_query_str, array($pic_result['pictureid'], $picinfo['board_id']))->row_array(0);
	    
		if($picinfo['tagname']['tagname1']){
		$pintagdata=array(
				'pinid'=>$pin_result['pinid'],
				'tagname'=>$picinfo['tagname']['tagname1']
		);
		$this->db->insert('pintag', $pintagdata);
		}
		if($picinfo['tagname']['tagname2']){
			$pintagdata=array(
					'pinid'=>$pin_result['pinid'],
					'tagname'=>$picinfo['tagname']['tagname2']
			);
			$this->db->insert('pintag', $pintagdata);
		}
		if($picinfo['tagname']['tagname3']){
			$pintagdata=array(
					'pinid'=>$pin_result['pinid'],
					'tagname'=>$picinfo['tagname']['tagname3']
			);
			$this->db->insert('pintag', $pintagdata);
		}
	}

	public function repin($boardid,$from_pinid)
	{
		$query_str="SELECT * FROM pin WHERE pinid = ?";
		$res=$this->db->query($query_str, $from_pinid)->result_array();
		$pic_id=$res[0]['pictureid'];
		
		$data1=array(
				'pictureid'=>$pic_id,
				'boardid'=>$boardid
		);
		$this->db->insert('pin', $data1);
		
		$query_str="SELECT * FROM pin WHERE boardid = ? order by pinid DESC";
		$res2=$this->db->query($query_str, $boardid)->result_array();
		$to_pinid=$res2[0]['pinid'];
		
		$data2=array(
				'from_pinid'=>$from_pinid,
				'to_pinid'=>$to_pinid
		);
		$this->db->insert('repin', $data2);
		
		$query_str="SELECT * FROM pintag WHERE pinid = ?";
		$res3=$this->db->query($query_str, $from_pinid)->result_array();
		foreach($res3 as $tagitem){
			$this->db->insert('pintag', array('pinid'=>$to_pinid,'tagname'=>$tagitem['tagname']));
		}
		
	}
	
	public function search($keyword)
	{   $search='%'.$keyword.'%';
		$query_str = "select * from pin p JOIN picture pc WHERE p.pictureid=pc.pictureid and p.pinid in (select pinid From Pintag where tagname like ?) order by p.date_create ";
		$pinpin=$this->db->query($query_str, $search)->result_array();
		
		
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
	
	public function searchbytime($keyword)
	{   $search='%'.$keyword.'%';
	$query_str = "select * from pin p JOIN picture pc WHERE p.pictureid=pc.pictureid and p.pinid in (select pinid From Pintag where tagname like ?) order by p.date_create DESC";
	$pinpin=$this->db->query($query_str, $search)->result_array();
	
	
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
	
	
	public function searchbylikes($keyword)
	{   $search='%'.$keyword.'%';
	$query_str = "select * from pin p JOIN picture pc WHERE p.pictureid=pc.pictureid and p.pinid in (select pinid From Pintag where tagname like ?) ";
	$pinpin=$this->db->query($query_str, $search)->result_array();
	
	
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
	
	

}