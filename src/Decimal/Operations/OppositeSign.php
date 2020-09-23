<?php

namespace Ducats\Decimal\Operations;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\Decimal;
use Ducats\Decimal\DecimalInterface;

class OppositeSign implements AsDecimal {

	private AsDecimal $as_decimal;

	public function __construct(AsDecimal $as_decimal) {
		$this->as_decimal = $as_decimal;
	}

	public function asDecimal(): DecimalInterface {
		$decimal = $this->as_decimal->asDecimal();
		return new Decimal(
			$decimal->significand() * -1,
			$decimal->exponent()
		);
	}
}
