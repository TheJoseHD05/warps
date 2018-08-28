<?php

namespace warps;





class Loader extends PluginBase{
public $title = "[ WARPS ] ";
  
  public function onEnable(){
   $this->getServer()->getLogger()->info($this->title." Warps enable");
    @mkdir($this->getDataFolder());
    @mkdir($this->getDataFolder()."/Warps-Data");
    self::enableLevelsWarps();
  }

public static function enableLevelsWarps(){
  if(empty($this->getDataFolder()."Warps-Data/")) return;
	$scan = scandir($this->getDataFolder()."Warps-Data/");
	foreach($scan as $files){
	if($files !== ".." and $files !== "."){
	$name = str_replace(".yml", "", $files);
	if($name == "") continue;
	$warp = new Config($this->getDataFolder()."Warps-Data/".$name.".yml", Config::YAML);
	if(empty($warp->get("warp-level"))) return;
	$level = $warp->get("warp-level");
	$this->getServer()->loadLevel($level);
  }
  }
}
  
  
 public static function createWarp(Player $player , $warp){
	 
if(file_exist($this->getDataFolder()."Warps-Data/".$warp.".yml")){
$player->sendMessage($this->title."This warp already exists");	
}else{
	$x = $player->getX();
	$y = $player->getY()+1;
	$z = $player->getZ();
	$pos = array($x,$y,$z);
	$level = $player->getLevel();
$data = new Config($this->getDataFolder()."Warps-Data/".$warp.".yml", Config::YAML,[
	"warp-name" => $warp,
	"warp-position" => $pos,
	"warp-level" => $level,
	]);
	$data->save();
	$player->sendMessage($this->title."Warp created name : ".$warp." in X:".$x." Y:".$y." Z:".$z." Level:".$level." is correct");
	
}
	 	 
	 
 }	 
	 
  
  
 public static function deleteWarp(Player $player , $warp){
	 
if(file_exist($this->getDataFolder()."Warps-Data/".$warp.".yml")){
unlink($this->getDataFolder()."Warp-Data/".$warp.".yml");
	$player->sendMessage($this->title." Warp removed");
}else{
$player->sendMessage($this->title."
This warp does not exist verify the name");	
}
	 
	 
 }
 public static function tpWarp($player,$warp){
	$cfg = new Config($this->getDataFolder()."Warp-Data/".$warp.".yml", Config::YAML);
	 $data = $cfg->get("warp-position");
	 $pos = new Vector3($data[0],$data[1],$data[2]);
	 $level = $this->getServer()->getLevelByName($cfg->get("warp-level"));
	 $name = $cfg->get("warp-name");
	 $player->teleport($pos,$level);
	 $player->sendMessage($this->title."Welcome to warp : ".$name);
	 return true;
 }
	
	public static function warpUI(){
	$paquete = ModalFormRequestPacket();
		$paquete->formId = 444444444;
		$datos = array();
		
		$datos = array(
		"title" => "Warps in the Server!",
		"type" => "form",
		"content" => "
Select a warp"
		);
		
	foreach(self::listwarpui() as $warp){
	$datos["buttons"][]= array("text" => $warp);	
	}
		
	}
	public static function listwarpui(){
	if(empty($this->getDataFolder()."Warps-Data/")) return;
	$scan = scandir($this->getDataFolder()."Warps-Data/");
	foreach($scan as $files){
	if($files !== ".." and $files !== "."){
	$name = str_replace(".yml", "", $files);
	if($name == "") continue;
	$warp = new Config($this->getDataFolder()."Warps-Data/".$name.".yml", Config::YAML);	
	return $warp->get("warp-name");	
	}
	}
	}
	public static function listWarp(Player $player){
		
	}
	public static function countWarps(){
		
$cantidad = count(array_filter(scandir("Warps-Data/",function($archivo){ return substr($archivo,strlen($archivo)-4)===".yml";})));	
return $cantidad;		
	}
  
public function onCommand(CommandSender $sender, Command $command, $label, array $args):bool{
	switch($command->getName()){  
  
		case "setwarp":
			if($sender->isOp()){
			if(!empty($args[0]){
				$name = $args[0];
				self::createWarp($sender,$name);
			}
			   }
			   return true;
			   case "delwarp":
			   if($sender->isOp()){
				if(!empty($args[0]){
					$name = $args[0];
					self::deleteWarp($sender,$name);
				}
			   }
				   return true;
				   case "listwarp":
				   if($sender->isOp()){
				self::listWarp($sender);	   
					   
				   }
				   return true;
  
  
  
  
  
  
  
  
	}
}
  
  
  
}
