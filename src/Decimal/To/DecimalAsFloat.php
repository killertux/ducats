<?php

namespace Ducats\Decimal\To;

use Ducats\Decimal\AsDecimal;

class DecimalAsFloat {
	private AsDecimal $as_decimal;

	public function __construct(AsDecimal $as_decimal) {
		$this->as_decimal = $as_decimal;
	}

	public function float(): float {
		$decimal = $this->as_decimal->asDecimal();
		return $decimal->significand() / (10 ** $decimal->exponent());
	}
}
