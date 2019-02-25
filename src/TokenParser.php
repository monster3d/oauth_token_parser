<?php

namespace OAutoTokenParser;

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Air\SupplierGates\TokenParser\Result;

class TokenParser
{
    /**
     * @var string
     */
    protected $publicKeyPath;

    /**
     * TokenChecker constructor.
     * @param string $publicKeyPath
     * @throws \Exception
     */
    public function __construct($publicKeyPath)
    {
        $publicKeyPath = realpath($publicKeyPath);
        if (!is_readable($publicKeyPath)) {
            throw new \Exception('public key file is not readable');
        }
        $this->publicKeyPath = $publicKeyPath;
    }

    /**
     * @param string $accessToken
     * @return Result
     */
    public function parseToken($accessToken)
    {
        $parser      = new Parser;
        $signer      = new Sha256;
        $publicKey   = new Key("file://{$this->publicKeyPath}");
        $parsedToken = $parser->parse($accessToken);

        $isValid    = $parsedToken->verify($signer, $publicKey);
        $userId     = (int)$parsedToken->getClaim('sub');
        $expiration = $parsedToken->getClaim('exp');

        $result = new Result($isValid, $expiration <= time(), $userId);

        return $result;
    }
}
