<?php
namespace Concrete\Package\BasicTablePackage\Block\BasicTableBlock\FieldTypes;

interface SelfSaveInterface{
	//some function that saves the values itself, not by the block
	public function saveValues($value);
}