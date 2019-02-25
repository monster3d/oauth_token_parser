<?php

namespace OAuthTokenParser\TokenParser;

class Result
{
    /**
     * @var int
     */
    protected $clientId;

    /**
     * @var bool
     */
    protected $isValid;

    /**
     * @var bool
     */
    protected $isExpired;

    /**
     * @var int|null
     */
    protected $userId;

    /**
     * @param bool $isValid
     * @param bool $isExpired
     * @param int|null $userId
     */
    public function __construct($isValid, $isExpired, $userId, $clientId)
    {
        $this->isValid   = $isValid;
        $this->isExpired = $isExpired;
        $this->userId    = $userId;
        $this->clientId  = $clientId;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * @return boolean
     */
    public function isExpired()
    {
        return $this->isExpired;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }
}
