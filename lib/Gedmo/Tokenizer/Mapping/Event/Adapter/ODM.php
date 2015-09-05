<?php

namespace Gedmo\Tokenizer\Mapping\Event\Adapter;

use Gedmo\Mapping\Event\Adapter\ODM as BaseAdapterODM;
use Gedmo\Tokenizer\Mapping\Event\TokenizerAdapter;

/**
 * Doctrine event adapter for ODM adapted
 * for Tokenizer behavior
 *
 * @author Ceif Khedhiri <ceif@khedhiri.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
final class ODM extends BaseAdapterODM implements TokenizerAdapter
{
    /**
     * {@inheritDoc}
     */
    public function getDateValue($meta, $field)
    {
        $mapping = $meta->getFieldMapping($field);
        if (isset($mapping['type']) && $mapping['type'] === 'string') {
            $date = new \DateTime();
            $token =base_convert(sha1(uniqid(mt_rand(1, 999) . $date->format('Y-m-d H:i:s'), true)), 16, 36);

            return $token;
        }
        return null;
    }
}