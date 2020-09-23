<?php

namespace Ducats\Decimal\Operations;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\Decimal;
use Ducats\Decimal\DecimalInterface;

class Product implements AsDecimal {

	private AsDecimal $as_decimal_a;
	private AsDecimal $as_decimal_b;

	public function __construct(AsDecimal $as_decimal_a, AsDecimal $as_decimal_b) {
		$this->as_decimal_a = $as_decimal_a;
		$this->as_decimal_b = $as_decimal_b;
	}

	public function asDecimal(): DecimalInterface {
		$decimal_a = $this->as_decimal_a->asDecimal();
		$decimal_b = $this->as_decimal_b->asDecimal();

		return (new Normalized(
			new Decimal(
				$decimal_a->significand() * $decimal_b->significand(),
				$decimal_a->exponent() + $decimal_b->exponent()
			)
		))->asDecimal();
	}
}
