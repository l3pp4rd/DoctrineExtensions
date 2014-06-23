<?php

namespace Gedmo\Tokenizer\Traits;

/**
 * Tokenizer Trait, usable with PHP >= 5.4
 *
 * @author Ceif Khedhiri <ceif@khedhiri.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
trait TokenizerDocument
{
    /**
     * @var \DateTime
     * @Gedmo\Tokenizer(on="create")
     * @ODM\String
     */
    private $token;

    /**
     * Sets token.
     *
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Returns token.
     *
     * @return token
     */
    public function getToken()
    {
        return $this->token;
    }
}
