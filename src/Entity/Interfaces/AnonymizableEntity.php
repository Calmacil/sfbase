<?php

namespace App\Entity\Interfaces;

/**
 * This interface represents objects that should have an easy way to anonymize sensible data.
 *
 * @author calmacil
 */
interface AnonymizableEntity
{
    /**
     * Anonymizes sensitive data.
     *
     *      public function anonymize(): void
     *      {
     *          $this->username = '######'
     *      }
     *
     * @return void
     */
    public function anonymize(): void;
}
