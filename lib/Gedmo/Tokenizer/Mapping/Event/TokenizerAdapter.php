<?php

namespace Gedmo\Tokenizer\Mapping\Event;

use Gedmo\Mapping\Event\AdapterInterface;

/**
 * Doctrine event adapter interface
 * for Tokenizer behavior
 *
 * @author Ceif Khedhiri <ceif@khedhiri.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
interface TokenizerAdapter extends AdapterInterface
{
    /**
     * Get the date value
     *
     * @param object $meta
     * @param string $field
     * @return mixed
     */
    function getDateValue($meta, $field);
}