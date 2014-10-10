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
	public $city="";
	public $company="";
	public $website="";
	public $image="";
	public $video="";
	public $bio="";
	public $talents=array();

	private $confirmed=0; //if the user is confirmed or not

	function User($id){
		$this->id=$id;
		$this->getInfo();
	}

	function getInfo(){
		global $mysqli;
		$talentString="";

		if($stmt=$mysqli->prepare("SELECT id,email,confirmed,membership,firstname,lastname,phone,businessphone,city,company,website,image,video,bio,talents FROM test WHERE id=?")){
			$stmt->bind_param("d",$this->id);
			$stmt->bind_result($this->id,$this->email,$this->confirmed,$this->membership,$this->firstname,$this->lastname,$this->phone,
				$this->bphone,$this->city,$this->company,$this->website,$this->image,$this->video,$this->bio,$talentString);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();

			$this->name=$this->firstname." ".$this->lastname;
			$this->talents=explode(",",$talentString);
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
		if($this->membership==3) return 10;

		return 0;
	}

	function showImage($width="200",$height="200",$class=""){
		echo '<img id=profile class="'.$class.'" src="'.$this->image.'" width="'.$width.'" height="'.$height.'">';
	}

	function showPhone(){
		echo "(" . substr($this->phone, 0, 3) . ")" . substr($this->phone, 3, 3) . "-" . substr($this->phone, 6);
	}

	function showBPhone(){
		echo "(" . substr($this->bphone, 0, 3) . ")" . substr($this->bphone, 3, 3) . "-" . substr($this->bphone, 6);
	}

}



?>