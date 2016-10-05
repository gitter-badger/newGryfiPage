<?php
/**
 * Created by PhpStorm.
 * User: lucius
 * Date: 22.08.16
 * Time: 18:59
 */

namespace Concrete\Package\BasicTablePackage\Src\FieldTypes;


use Concrete\Core\Session\SessionFactory;
use Concrete\Package\BasicTablePackage\Src\Entity;
use Symfony\Component\HttpFoundation\Session\Session;
use Concrete\Core\Support\Facade\Application;

class DirectEditAssociatedEntityField extends DropdownLinkField implements DirectEditInterface
{


    const SUBFORMERROR = " has an Error.";

    protected $subErrorMsg = array();

    /**
     * @param $form
     * @param bool $clientSideValidationActivated
     * @return string
     */
    public function getFormView($form, $clientSideValidationActivated = true){
        /**
         * @var Entity $value
         */
        $value = $this->getSQLValue();
        $this->loadSubErrorMsg();
        $html = "
        <div class='subentityedit col-xs-12'>

            <label>".$this->getLabel()."</label>
            <div class='row'>
        ";

        $classname = $this->targetEntity;

        /**
         * @var Entity $entityForFields
         */
        $entityForFields = new $classname();


        //get the fields to show in the form

        $fields = $entityForFields->getFieldTypes();


        //build the form
        /**
         * @var Field $field
         */
        foreach ($fields as $field){
            //if id or another directedit possibility, skip (because of possible circle)
            if($field instanceof DirectEditInterface){
                continue;
            }

            if(is_null($value)){
                $setValue = null;
            }else{
                $setValue = $value->get($field->getSQLFieldName());
            }
            //set the value
            $field->setSQLValue($setValue);
            //change the post name
            $field->setPostName($this->getPostName()."[".$field->getPostName()."]");

            if(isset($this->subErrorMsg[$field->getPostName()])){
                $field->setErrorMessage($this->subErrorMsg[$field->getPostName()]);
            }

            //get the form view
            $html.=$field->getFormView($form, $clientSideValidationActivated);
            $field->setErrorMessage(null);
        }
        $idNewEntryCheckbox = $this->getPostName()
            .static::REPLACE_BRACE_IN_ID_WITH
            ."newentrycheckbox"
            .static::REPLACE_BRACE_IN_ID_WITH;
        $nameNewEntryCheckbox = $this->getPostName()."[newentrycheckbox]";
        $html.="
        <div class='basic-table-newentrycheckbox'>
            <label for='$idNewEntryCheckbox'>".t("Create new entry of %s",$this->getLabel())."</label>
            <input type='checkbox' value='Off' id='$idNewEntryCheckbox' name='$nameNewEntryCheckbox'/>
            </div>
        ";



        $html.="<div class='parent_postname hiddenforminfo'>".$this->getPostName()."</div>";
        $html.="<div class='parent_idname hiddenforminfo'>".$this->getHtmlId()."</div>";
        $html.="<div class='replace_brace_in_id_with hiddenforminfo'>".static::REPLACE_BRACE_IN_ID_WITH."</div>";
        $html.="<div class='prepended_before_realname hiddenforminfo'>".static::PREPEND_BEFORE_REALNAME."</div>";
        $html.="<div class='options_url hiddenforminfo'>".$this->view->action("get_options_of_field")."?fieldname=".$this->getPostName()."</div>";
        $html.="<div class='options_template hiddenforminfo'>".$entityForFields->getTypeaheadTemplate()."</div>";







        // TODO put the id in the form somehow

        $html.="</div>
           </div>
        ";
        //TODO get javascript logic for editing existing object or create new one


    		$html.=$this->getHtmlErrorMsg();  


        return $html;
    }

    public function validatePost($value)
    {
        if($value == null || !is_array($value)){
            $this->setSQLValue(null);
        }
        //TODO first check if new entry or existing should be used

        //create entity or modify it
        $newModel = new $this->targetEntity;

        $fields = $newModel->getFieldTypes();
        $error = false;
        /**
         * @var Field $field
         */
        foreach ($fields as $field){
            if($field->getSQLFieldName() == $newModel->getIdFieldName() || $field instanceof DirectEditInterface){
                continue;
            }
            if($field->validatePost($value[$field->getPostName()])){
                $newModel->set($field->getSQLFieldName(), $field->getSQLValue());
            }else{
                $this->subErrorMsg[$field->getPostName()] = $field->getErrorMsg();
                $error = true;
            }
        }

        if($error){
            $this->errMsg = $this->getLabel().t(static::SUBFORMERROR);
            $this->saveSubErrorMsg();
            return false;
        }



        //persist it

        $this->getEntityManager()->persist($newModel);
        //set the value
        $this->setSQLValue($newModel);
        return true;
    }


    protected function saveSubErrorMsg(){
        $app = Application::getFacadeApplication();

        /**
         * @var Session $session
         */
        $session = $app['session'];

        $session->set($this->postName."subformerrors", $this->subErrorMsg);
    }

    protected function loadSubErrorMsg(){
        $app = Application::getFacadeApplication();

        /**
         * @var Session $session
         */
        $session = $app['session'];
        if(count($this->subErrorMsg)>0){
            $session->remove($this->postName."subformerrors");
            return $this->subErrorMsg;
        }


        $this->subErrorMsg=$session->get($this->postName."subformerrors", array());
        $session->remove($this->postName."subformerrors");
        return $this->subErrorMsg;

    }
}

