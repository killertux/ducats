<?php

namespace Ducats\Decimal\Operations;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\Decimal;
use Ducats\Decimal\DecimalInterface;

class DecreaseExponent implements AsDecimal {

	private AsDecimal $as_decimal;
	private int $new_exponent;

	public function __construct(AsDecimal $as_decimal, int $new_exponent) {
		$this->as_decimal = $as_decimal;
		$this->new_exponent = $new_exponent;
	}

	public function asDecimal(): DecimalInterface {
		$decimal = $this->as_decimal->asDecimal();
		$exponent = $decimal->exponent();
		if ($exponent < $this->new_exponent) {
			throw new \InvalidArgumentException('New exponent should be smaller than current decimal exponent');
		}
		if ($exponent === $this->new_exponent) {
			return $decimal;
		}
		$exponent_diff = $exponent - $this->new_exponent;
		return new Decimal(
			$decimal->significand() * (10 ** $exponent_diff),
			$this->new_exponent
		);
	}
}
