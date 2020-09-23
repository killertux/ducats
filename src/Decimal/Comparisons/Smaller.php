<?php

namespace Ducats\Decimal\Comparisons;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\Operations\Difference;

class Smaller implements Comparison {

	private AsDecimal $as_decimal_a;
	private AsDecimal $as_decimal_b;

	public function __construct(AsDecimal $as_decimal_a, AsDecimal $as_decimal_b) {
		$this->as_decimal_a = $as_decimal_a;
		$this->as_decimal_b = $as_decimal_b;
	}

	public function compare(): bool {
		return (new Difference($this->as_decimal_a, $this->as_decimal_b))
			->asDecimal()->significand() < 0;
	}
}
