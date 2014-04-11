<?php

/**
 * Website_Auth_ObjectAdapter
 *
 * Website_Auth_ObjectAdapter provides the ability to authenticate against
 * credentials stored in an Pimcore object. All configuration options can
 * be set through the constructor and through instance methods, one for each
 * option.
 *
 * @version 0.5
 */

class Website_Auth_ObjectAdapter implements Zend_Auth_Adapter_Interface
{
    /**
     * $_identityValue - Identity value
     *
     * @var string 
     */
    protected $_identityValue;

    /**
     * $_credentialValue - Credential value
     *
     * @var string
     */
    protected $_credentialValue;

    /**
     * $_identityClassname - Classname of the object
     *
     * @var string
     */
    protected $_identityClassname;

    /**
     * $_identityColumn - The column to use as the identity
     *
     * @var string
     */
    protected $_identityColumn;

    /**
     * $_credentialColumn - The column to use as the credential
     *
     * @var string
     */
    protected $_credentialColumn;

    /**
     * $_objectPath - Path in the object tree where the identity oject is stored
     *
     * @var string
     */
    protected $_objectPath;

    /**
     * __construct() - Sets the configaration options
     *
     * @param string $identityClassname
     * @param string $identityColumn
     * @param string $credentialColumn
     * @param string $objectPath
     * @return void
     */
    public function __construct($identityClassname = null, $identityColumn = null, $credentialColumn = null, $objectPath = null)
    {

# PF: Changed. Stopped working in Pimcore 1.4+.
#        Zend_Db_Table::setDefaultAdapter(Pimcore_Resource_Mysql::get()); 
        Zend_Db_Table::setDefaultAdapter(Pimcore_Resource_Mysql::get()->getResource());

        if (null !== $identityClassname) {
            $this->setIdentityClassname($identityClassname);
        }

        if (null !== $identityColumn) {
            $this->setIdentityColumn($identityColumn);
        }

        if (null !== $credentialColumn) {
            $this->setCredentialColumn($credentialColumn);
        }

        if (null !== $objectPath) {
            $this->setObjectPath($objectPath);
        }
    }

    /**
     * setIdentityClassname() - set classname of the object
     *
     * @param string $identityClassname
     * @throws Zend_Auth_Adapter_Exception
     * @return Website_Auth_ObjectAdapter Provides a fluent interface
     */
    public function setIdentityClassname($identityClassname)
    {
        if (!class_exists($identityClassname)) {
            throw new Zend_Auth_Adapter_Exception('invalid classname [' . $identityClassname . ']');
        }

        $this->_identityClassname = $identityClassname;
        return $this;
    }

    /**
     * authenticate() - Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
     * @return Zend_Auth_Result 
     */
    public function authenticate()
    {
        $this->_authenticateSetup();

        $authResultCode = Zend_Auth_Result::FAILURE;
        $authResultIdentity = null;
        $authResultMessages = array();

        $identities = $this->_getIdentityFromObject();

        if (count($identities) == 0) {
            $authResultCode = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
        } elseif (count($identities) == 1) {

            $identity = $identities->current();
            if ($this->_checkCredential($identity)) {
                $authResultCode = Zend_Auth_Result::SUCCESS;
                $authResultIdentity = $identity;
            } else {
                $authResultCode = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
            }

        } else {
            $authResultCode = Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS;
        }

        return new Zend_Auth_Result($authResultCode, $authResultIdentity, $authResultMessages);
    }

    /**
     * _authenticateSetup() - This method abstracts the steps involved with
     * making sure that this adapter was indeed setup properly with all
     * required pieces of information.
     *
     * @throws Zend_Auth_Adapter_Exception - in the event that setup was not done properly
     * @return true
     */
    protected function _authenticateSetup()
    {
        $exception = null;

        if ($this->_identityClassname == '') {
            $exception = 'A classname must be supplied for the ' . __CLASS__ . ' authentication adapter.';
        } elseif ($this->_identityColumn == '') {
            $exception = 'An identity column must be supplied for the ' . __CLASS__ . ' authentication adapter.';
        } elseif ($this->_credentialColumn == '') {
            $exception = 'A credential column must be supplied for the ' . __CLASS__ . ' authentication adapter.';
        } elseif ($this->_identityValue == '') {
            $exception = 'A value for the identity was not provided prior to authentication with ' . __CLASS__ . '.';
        } elseif ($this->_credentialValue === null) {
            $exception = 'A credential value was not provided prior to authentication with ' . __CLASS__ . '.';
        }

        if (null !== $exception) {
            throw new Zend_Auth_Adapter_Exception($exception);
        }

        return true;
    }

    /**
     * _getIdentityFromObject() - loads the identity from the database
     *
     * @return Object_List_Concrete
     */
    protected function _getIdentityFromObject()
    {
        $className = $this->_identityClassname . '_List';
        $objectList = new $className;
        $objectList->setCondition($this->_getCondition());
        $objectList->load();

        return $objectList;
    }

    /**
     * _getCondition() - build the conditions for getting the identity
     * 
     * @return string 
     */
    protected function _getCondition()
    {
        $conditions = array();
        $conditions[] = Zend_Db_Table::getDefaultAdapter()->quoteInto($this->_identityColumn . ' = ?', $this->_identityValue);

        if ($this->_objectPath) {
            $conditions[] = Zend_Db_Table::getDefaultAdapter()->quoteInto('o_path = ?', $this->_objectPath);
        }

        return implode(' AND ', $conditions);
    }

    /**
     * _checkCredential() - This method attempts to validate that
     * the record in the result is indeed a record that matched the
     * identity provided to this adapter.
     *
     * @param Object_Concrete $user
     * @return bool
     */
    protected function _checkCredential(Object_Concrete $user)
    {
        return $user->{$this->_credentialColumn} == md5($this->_credentialValue);
    }

    /**
     * setIdentityColumn() - set the column name to be used as the identity column
     * 
     * @param string $identityColumn
     * @return Website_Auth_ObjectAdapter Provides a fluent interface
     */
    public function setIdentityColumn($identityColumn)
    {
        $this->_identityColumn = $identityColumn;
        return $this;
    }

    /**
     * setCredentialColumn() - set the column name to be used as the credential column
     * 
     * @param string $credentialColumn
     * @return Website_Auth_ObjectAdapter Provides a fluent interface
     */
    public function setCredentialColumn($credentialColumn)
    {
        $this->_credentialColumn = $credentialColumn;
        return $this;
    }

    /**
     * setObjectPath() - sets the path in the object tree where the identity oject is stored. 
     * This setting is optional, when no path is set the path will not been checked
     * 
     * @param string $objectPath
     * @return Website_Auth_ObjectAdapter Provides a fluent interface
     */
    public function setObjectPath($objectPath)
    {
        $this->_objectPath = $objectPath;
        return $this;
    }

    /**
     * setIdentity() - set the value to be used as the identity
     *
     * @param string $identityValue
     * @return Website_Auth_ObjectAdapter Provides a fluent interface
     */
    public function setIdentity($identityValue)
    {
        $this->_identityValue = $identityValue;
        return $this;
    }

    /**
     * setCredential() - set the credential value to be used
     *
     * @param string $credentialValue
     * @return Website_Auth_ObjectAdapter Provides a fluent interface
     */
    public function setCredential($credentialValue)
    {
        $this->_credentialValue = $credentialValue;
        return $this;
    }
}