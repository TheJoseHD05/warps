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
	if(empty($warp->get("level"))) return;
	$level = $warp->get("level");
	$this->getServer()->loadLevel($level);
  }
  }
}
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
}
