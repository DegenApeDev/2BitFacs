<?php
namespace _2BitRealms\faction;
class Faction {
	
	private $name;
	private $description;
	private $leader;
	
	public function getName(){
		return $this->name;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function __construct($name, $leader){
		$this->name = $name;
		$this->description = "Default description :(";
		$this->leader = $leader;
		//TODO: Finish
	}
	
}