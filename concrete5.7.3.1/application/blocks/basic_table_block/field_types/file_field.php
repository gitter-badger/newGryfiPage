<?php
namespace Application\Block\BasicTableBlock\FieldTypes;

use Concrete\Core\Block\BlockController;
use Application\Block\BasicTableBlock\Field as Field;
use Loader;
use Page;
use User;
use Core;
use File;
use Concrete\Controller\SinglePage\Dashboard\Blocks\Permissions as Permissions;
use Concrete\Core\Block\View\BlockView as View;

class FileField extends Field{
	
	public function __construct($sqlFieldname,$label, $postName){
		parent::__construct($sqlFieldname, $label, $postName);
		
	}
	
	public function setValue($value){
		$this->value = $value;
	}
	
	public function getTableView(){
		$f = $this->getFileObject();
		//$fp = new Permissions($f);
		if (/*$fp->canViewFile()*/true) { 
			$c = Page::getCurrentPage();
			if($c instanceof Page) {
				$cID = $c->getCollectionID();
			}
	
			$returnString = "<a href=\"".View::url('/download_file', $this->getValue(),$cID)."\">".stripslashes($this->getLinkText())."</a>";
			
		}else{
			$returnString = "keine Berechtigung";
		}
		
		return $returnString;
	}
	
	
	public function getFormView($form){
		$al = Loader::helper('concrete/asset_library');
		$bf = null;
		if ($this->getValue() > 0) {
			$bf = $this->getFileObject();
		}
		$returnString = "
		<div class=\"form-group\">
		".$form->label($this->getPostName(), t('File'))."
		".$al->file($this->getPostName(), $this->getPostName(), t('Choose File'), $bf)."
		</div>";
		
		return $returnString;
	}
	
	
	
	public function getValue(){
		return $this->value;
	}
	
	
	
	
	
	
	

	function getFileObject() {
		if(is_null($this->value)){
			return false;
		}
		return File::getByID($this->value);
	}
	
	function getLinkText() {	
		$f = $this->getFileObject();
		if(is_object($f)){
			return $f->getTitle();
		}else{
			return t("keine Datei");
		}
		
	}
}