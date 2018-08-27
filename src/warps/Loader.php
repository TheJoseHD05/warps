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
$data = new Config($this->getDataFolder()."/".$warp.".yml", Config::YAML,[
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
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
}
