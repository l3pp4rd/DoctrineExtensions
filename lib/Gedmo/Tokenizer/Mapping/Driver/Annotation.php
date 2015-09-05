<?php

namespace Gedmo\Tokenizer\Mapping\Driver;

use Gedmo\Mapping\Driver\AbstractAnnotationDriver,
    Doctrine\Common\Annotations\AnnotationReader,
    Gedmo\Exception\InvalidMappingException;

/**
 * This is an annotation mapping driver for Tokenizer
 * behavioral extension. Used for extraction of extended
 * metadata from Annotations specifically for Tokenizer
 * extension.
 *
 * @author Ceif Khedhiri <ceif@khedhiri.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class Annotation extends AbstractAnnotationDriver
{
    /**
     * Annotation field is Tokenizer
     */
    const TOKENIZER = 'Gedmo\\Mapping\\Annotation\\Tokenizer';

    /**
     * List of types which are valid for timestamp
     *
     * @var array
     */
    protected $validTypes = array(
        'string',
    );

    /**
     * {@inheritDoc}
     */
    public function readExtendedMetadata($meta, array &$config) {
        $class = $this->getMetaReflectionClass($meta);

        // property annotations
        foreach ($class->getProperties() as $property) {
            if ($meta->isMappedSuperclass && !$property->isPrivate() ||
                $meta->isInheritedField($property->name) ||
                isset($meta->associationMappings[$property->name]['inherited'])
            ) {
                continue;
            }
            if ($tokenizer = $this->reader->getPropertyAnnotation($property, self::TOKENIZER)) {
                $field = $property->getName();
                if (!$meta->hasField($field)) {
                    throw new InvalidMappingException("Unable to find timestampable [{$field}] as mapped property in entity - {$meta->name}");
                }
                if (!$this->isValidField($meta, $field)) {
                    throw new InvalidMappingException("Field - [{$field}] type is not valid and must be 'date', 'datetime' or 'time' in class - {$meta->name}");
                }
                if (!in_array($tokenizer->on, array('update', 'create', 'change'))) {
                    throw new InvalidMappingException("Field - [{$field}] trigger 'on' is not one of [update, create, change] in class - {$meta->name}");
                }
                if ($tokenizer->on == 'change') {
                    if (!isset($tokenizer->field)) {
                        throw new InvalidMappingException("Missing parameters on property - {$field}, field must be set on [change] trigger in class - {$meta->name}");
                    }
                    if (is_array($tokenizer->field) && isset($tokenizer->value)) {
                        throw new InvalidMappingException("Timestampable extension does not support multiple value changeset detection yet.");
                    }
                    $field = array(
                        'field' => $field,
                        'trackedField' => $tokenizer->field,
                        'value' => $tokenizer->value,
                    );
                }
                // properties are unique and mapper checks that, no risk here
                $config[$tokenizer->on][] = $field;
            }
        }
    }
}
