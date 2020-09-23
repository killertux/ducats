<?php

namespace Ducats\Decimal\Operations;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\Comparisons\Greater;
use Ducats\Decimal\Comparisons\Smaller;
use Ducats\Decimal\Decimal;
use Ducats\Decimal\DecimalInterface;
use Ducats\Decimal\From\StringAsDecimal;
use Ducats\Decimal\To\DecimalAsFloat;

class Quotient implements AsDecimal {

	private AsDecimal $as_decimal_a;
	private AsDecimal $as_decimal_b;

	public function __construct(AsDecimal $as_decimal_a, AsDecimal $as_decimal_b) {
		$this->as_decimal_a = $as_decimal_a;
		$this->as_decimal_b = $as_decimal_b;
	}

	public function asDecimal(): DecimalInterface {
		/** @var AsDecimal $dividend */
		/** @var AsDecimal $divisor */
		$dividend = $this->as_decimal_a->asDecimal();
		$divisor = $this->as_decimal_b->asDecimal();

		if ($divisor->significand() === 0) {
			throw new \Exception("Fuck");
		}

		if ($divisor->significand() === 1 || $divisor->significand() === -1) {
			return (new Product($dividend, new Decimal($divisor->significand(), -$divisor->exponent())))
				->asDecimal();
		}

		return (new StringAsDecimal(
			(new DecimalAsFloat($this->as_decimal_a))->float()
			/
			(new DecimalAsFloat($this->as_decimal_b))->float()
		))->asDecimal();
	}
}
