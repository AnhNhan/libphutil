<?php

/**
 * Prior to PHP 5.3, PHP does not support nested exceptions; this class provides
 * limited support for nested exceptions. Use methods on
 * @{class:PhutilErrorHandler} to unnest exceptions in a forward-compatible way.
 *
 * @concrete-extensible
 * @group error
 */
class PhutilProxyException extends Exception {

  private $previousException;

  public function __construct($message, Exception $previous, $code = 0) {
    $this->previousException = $previous;

    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
      parent::__construct($message, $code, $previous);
    } else {
      parent::__construct($message, $code);
    }
  }

  public function getPreviousException() {
    // NOTE: This can not be named "getPrevious()" because that method is final
    // after PHP 5.3. Similarly, the property can not be named "previous"
    // because
    return $this->previousException;
  }

}
