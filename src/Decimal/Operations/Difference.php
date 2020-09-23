<?php

namespace Ducats\Decimal\Operations;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\DecimalInterface;

class Difference implements AsDecimal {

	private AsDecimal $as_decimal_a;
	private AsDecimal $as_decimal_b;

	public function __construct(AsDecimal $as_decimal_a, AsDecimal $as_decimal_b) {
		$this->as_decimal_a = $as_decimal_a;
		$this->as_decimal_b = $as_decimal_b;
	}

	public function asDecimal(): DecimalInterface {
		return (new Sum(
			$this->as_decimal_a,
			new OppositeSign($this->as_decimal_b)
		))->asDecimal();
	}
}
