<?php 
class ManDevMod extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
		$this->load->database();
	}
	
	//条件查询符合要求的设备
	public function searchDevs($plateform,$brand,$version,$status,$category,$borrower){
		$queryString = "select a.id,a.device_name,a.model,a.theNum,a.owner,a.status,a.borrower,a.borrow_time,b.path from devices a,dev_imgs b where a.id=b.device_id";
		
		if($plateform == "all"){
			
		}else{
			$queryString = $queryString.' and a.plateform="'.$plateform.'"';
		}
		if($brand == "all"){
			
		}else{
			$queryString = $queryString.' and a.brand="'.$brand.'"';
		}
		if($version == "all"){
			
		}else{
			$queryString = $queryString.' and a.version like "'.$version.'"';
		}
		if($status == "all"){
			
		}else{
			$queryString = $queryString.' and a.status="'.$status.'"';
		}
		if($category == "all"){
			
		}else{
			$queryString = $queryString.' and a.category="'.$category.'"';
		}
		if($borrower == ""){
			
		}else{
			$queryString = $queryString.' and a.borrower like "%'.$borrower.'%"';
		}
		
		
		$query = $this->db->query($queryString);
		$arr = $query->result();
		$jresult = json_encode($arr);
		return $arr;	
	}
	

	//借出设备或确认申请设备
	function confirmBorrowed($id,$borrower){
		$data = array(
				"status" => "2",
				"borrower" => $borrower
		);
		$this->db->where("id",$id);
		$this->db->update("devices",$data);
	}
	
	//归还设备
	function confirmReturned($id){
		$data = array(
				"status" => "0"
		);
		$this->db->where("id",$id);
		$this->db->update("devices",$data);
		return "sucess";
	}
	
	//删除设备
	function deleteDev($id){
		$this->db->where('id',$id);
		$this->db->delete('devices');
		
		return "sucess";
	}
	
	//修改设备
	function changeDevInfo(){
		
		return "sucess";
	}
	
	//修改签借人
	function changeBorrower($id,$borrower){
		$data = array(
				"borrower" => $borrower
		);
		$this->db->where("id",$id);
		$this->db->update("devices",$data);
		
		return "sucess";
	}
	
	
	
	
}
?>