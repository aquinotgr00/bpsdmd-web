<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class SupplyFiles extends \App\Entities\SupplyFiles implements \Doctrine\ORM\Proxy\Proxy
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
    public static $lazyPropertiesDefaults = [];



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
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'id', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'file_name', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'uploaded_by', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'created_at', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'org_id', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'path'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'id', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'file_name', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'uploaded_by', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'created_at', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'org_id', '' . "\0" . 'App\\Entities\\SupplyFiles' . "\0" . 'path'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (SupplyFiles $proxy) {
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
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
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
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getFileName(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFileName', []);

        return parent::getFileName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFileName($file_name): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFileName', [$file_name]);

        parent::setFileName($file_name);
    }

    /**
     * {@inheritDoc}
     */
    public function getUploadedBy(): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUploadedBy', []);

        return parent::getUploadedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setUploadedBy(\App\Entities\User $uploaded_by): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUploadedBy', [$uploaded_by]);

        parent::setUploadedBy($uploaded_by);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt($created_at): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', [$created_at]);

        parent::setCreatedAt($created_at);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrg(): \App\Entities\Organization
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrg', []);

        return parent::getOrg();
    }

    /**
     * {@inheritDoc}
     */
    public function setOrg(\App\Entities\Organization $org_id): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrg', [$org_id]);

        parent::setOrg($org_id);
    }

    /**
     * {@inheritDoc}
     */
    public function getPath(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPath', []);

        return parent::getPath();
    }

    /**
     * {@inheritDoc}
     */
    public function setPath($path): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPath', [$path]);

        parent::setPath($path);
    }

}
