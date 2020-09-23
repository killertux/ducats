<?php

namespace Ducats\Decimal;

use Ducats\Decimal\From\StringAsDecimal;
use Ducats\Decimal\Operations\Difference;
use Ducats\Decimal\Operations\Product;
use Ducats\Decimal\Operations\Quotient;
use Ducats\Decimal\Operations\Sum;

class DecimalValue implements AsDecimal {

	private AsDecimal $as_decimal;

	public function __construct(AsDecimal $as_decimal) {
		$this->as_decimal = $as_decimal;
	}

	public static function fromString(string $value): self {
		return new self(new StringAsDecimal($value));
	}

	public function asDecimal(): DecimalInterface {
		return $this->as_decimal->asDecimal();
	}

	public function add(AsDecimal $value): self {
		return new self(new Sum($this->as_decimal, $value));
	}

	public function subtract(AsDecimal $value): self {
		return new self(new Difference($this->as_decimal, $value));
	}

	public function multiply(AsDecimal $value): self {
		return new self(new Product($this->as_decimal, $value));
	}

	public function divide(AsDecimal $value): self {
		return new self(new Quotient($this->as_decimal, $value));
	}
}
