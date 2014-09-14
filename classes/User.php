<?php

/*


The user object, used to hold all user fields and functions


*/


class User{

	public $id=0;		 	//the users unique id
	public $email=""; 		//the users email
	public $membership=0; 	//users membership level
	public $firstname=""; 	//the users first name
	public $lastname="";	//the users last name
	public $name="";
	public $phone="";
	public $bphone="";
	public $image="";
	public $video="";
	public $bio="";
	public $talents=array();

	private $confirmed=0; //if the user is confirmed or not

	function User($id){
		$this->id=$id;
		$this->getInfo();

		$this->getTalents(); //made this a separate function because the query would be crazy long
	}

	function getInfo(){
		global $mysqli;

		if($stmt=$mysqli->prepare("SELECT id,email,confirmed,membership,firstname,lastname,phone,businessphone,image,video,bio FROM test WHERE id=?")){
			$stmt->bind_param("d",$this->id);
			$stmt->bind_result($this->id,$this->email,$this->confirmed,$this->membership,$this->firstname,$this->lastname,$this->phone,$this->businessphone,$this->image,$this->video,$this->bio);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();

			$this->name=$this->firstname." ".$this->lastname;
		}
	}

	function getTalents(){
		global $mysqli;

		if($stmt=$mysqli->prepare("SELECT talent1,talent2,talent3,talent4,talent5,talent6,talent7 FROM test WHERE id=?")){
			$stmt->bind_param("d",$this->id);
			$stmt->bind_result($t1,$t2,$t3,$t4,$t5,$t6,$t7);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();

			$filter=array($t1,$t2,$t3,$t4,$t5,$t6,$t7);

			foreach($filter as $talent){
				if(strlen($talent)>0)
					$this->talents[]=$talent;
			}
		}
	}

	function isConfirmed(){
		return $this->confirmed;
	}

	function hasBusinessPhone(){
		return strlen($this->bphone>0);
	}

	function hasImage(){
		return strlen($this->image)>0;
	}

	function hasBio(){
		return strlen($this->bio)>0;
	}

	function hasVideo(){
		return strlen($this->video)>0;
	}

	function bioLength(){
		if($this->membership==1) return 500;
		if($this->membership==2) return 1500;
		if($this->membership==3) return 3000;

		return 0;
	}

	function numTalents(){
		if($this->membership==1) return 3;
		if($this->membership==2) return 5;
		if($this->membership==3) return 7;

		return 0;
	}

	function showImage($width="200",$height="200",$class=""){
		echo '<img class="'.$class.'" src="'.$this->image.'" width="'.$width.'" height="'.$height.'">';
	}

}



?>