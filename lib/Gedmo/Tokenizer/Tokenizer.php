<?php

namespace Gedmo\Tokenizer;

/**
 * This interface is not necessary but can be implemented for
 * Entities which in some cases needs to be identified as
 * Tokenizer
 * 
 * @author Ceif Khedhiri <ceif@khedhiri.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
interface Tokenizer
{
    // Tokenizer expects annotations on properties
    
    /**
     * @gedmo:Tokenizer(on="create")
     * token which should be updated on insert only
     */
    
    /**
     * @gedmo:Tokenizer(on="update")
     * token which should be updated on update and insert
     */
    
    /**
     * @gedmo:Tokenizer(on="change", field="field", value="value")
     * token which should be updated on changed "property"
     * value and become equal to given "value"
     */

    /**
     * @gedmo:Tokenizer(on="change", field="field")
     * token which should be updated on changed "property"
     */

    /**
     * @gedmo:Tokenizer(on="change", fields={"field1", "field2"})
     * token which should be updated if at least one of the given fields changed
     */

    /**
     * example
     * 
     * @gedmo:Tokenizer(on="create")
     * @Column(type="string")
     * $token
     */
}