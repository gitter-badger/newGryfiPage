<?php

namespace DoctrineProxies\__CG__\Concrete\Package\BasicTablePackage\Src\BlockOptions;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class GroupRefOption extends \Concrete\Package\BasicTablePackage\Src\BlockOptions\GroupRefOption implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }

    /**
     * {@inheritDoc}
     * @param string $name
     */
    public function __get($name)
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__get', array($name));

        return parent::__get($name);
    }

    /**
     * {@inheritDoc}
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', array($name, $value));

        return parent::__set($name, $value);
    }



    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'optionType', 'GroupAssociations', 'id', 'optionValue', 'BasicTableInstance', 'possibleValues', 'optionName', 'protect', 'protectRead', 'protectWrite', 'fieldTypes', 'em', 'defaultFormView', 'defaultSubFormView', 'checkingConsistency');
        }

        return array('__isInitialized__', 'optionType', 'GroupAssociations', 'id', 'optionValue', 'BasicTableInstance', 'possibleValues', 'optionName', 'protect', 'protectRead', 'protectWrite', 'fieldTypes', 'em', 'defaultFormView', 'defaultSubFormView', 'checkingConsistency');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (GroupRefOption $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getLabel()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLabel', array());

        return parent::getLabel();
    }

    /**
     * {@inheritDoc}
     */
    public function getFieldType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFieldType', array());

        return parent::getFieldType();
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValue', array());

        return parent::getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function setValue($GroupAssociations)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setValue', array($GroupAssociations));

        return parent::setValue($GroupAssociations);
    }

    /**
     * {@inheritDoc}
     */
    public function set($name, $value)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'set', array($name, $value));

        return parent::set($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function setPossibleValues($possibleValues)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPossibleValues', array($possibleValues));

        return parent::setPossibleValues($possibleValues);
    }

    /**
     * {@inheritDoc}
     */
    public function getPossibleValues()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPossibleValues', array());

        return parent::getPossibleValues();
    }

    /**
     * {@inheritDoc}
     */
    public function getFormView($form)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFormView', array($form));

        return parent::getFormView($form);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultFormViews()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDefaultFormViews', array());

        return parent::setDefaultFormViews();
    }

    /**
     * {@inheritDoc}
     */
    public function setControllerFieldType($name, \Concrete\Package\BasicTablePackage\Src\FieldTypes\Field $field)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setControllerFieldType', array($name, $field));

        return parent::setControllerFieldType($name, $field);
    }

    /**
     * {@inheritDoc}
     */
    public function getFieldTypes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFieldTypes', array());

        return parent::getFieldTypes();
    }

    /**
     * {@inheritDoc}
     */
    public function getAsAssoc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAsAssoc', array());

        return parent::getAsAssoc();
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityManager()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEntityManager', array());

        return parent::getEntityManager();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getIdFieldName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdFieldName', array());

        return parent::getIdFieldName();
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultFieldTypes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDefaultFieldTypes', array());

        return parent::setDefaultFieldTypes();
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultValues()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDefaultValues', array());

        return parent::setDefaultValues();
    }

    /**
     * {@inheritDoc}
     */
    public function mergeCollections($coll1, $coll2)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'mergeCollections', array($coll1, $coll2));

        return parent::mergeCollections($coll1, $coll2);
    }

    /**
     * {@inheritDoc}
     */
    public function toTableAssoc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toTableAssoc', array());

        return parent::toTableAssoc();
    }

    /**
     * {@inheritDoc}
     */
    public function getTypeaheadTemplate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTypeaheadTemplate', array());

        return parent::getTypeaheadTemplate();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultFormView($form, $clientSideValidationActivated = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDefaultFormView', array($form, $clientSideValidationActivated));

        return parent::getDefaultFormView($form, $clientSideValidationActivated);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultSubFormView($form, $clientSideValidationActivated = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDefaultSubFormView', array($form, $clientSideValidationActivated));

        return parent::getDefaultSubFormView($form, $clientSideValidationActivated);
    }

    /**
     * {@inheritDoc}
     */
    public function checkConsistency()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'checkConsistency', array());

        return parent::checkConsistency();
    }

    /**
     * {@inheritDoc}
     */
    public function get($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'get', array($name));

        return parent::get($name);
    }

}
