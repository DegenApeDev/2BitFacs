<?php
namespace _2BitRealms\faction;
class Faction {
	
	private $name = "Wilderness";
	private $description = "Default description :(";
	
	public function getName(){
		return $this->name;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function __construct($name, $leader){
		$this->name = $name;
		//TODO: Finish
	}
	
}