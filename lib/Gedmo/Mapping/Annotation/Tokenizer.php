<?php

namespace Gedmo\Mapping\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Tokenizer annotation for Tokenizer behavioral extension
 *
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author Ceif Khedhiri <ceif@khedhiri.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
final class Tokenizer extends Annotation
{
    /** @var string */
    public $on = 'update';
    /** @var string|array */
    public $field;
    /** @var mixed */
    public $value;
}

