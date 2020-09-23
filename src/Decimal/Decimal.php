<?php

namespace Ducats\Decimal;

class Decimal implements DecimalInterface {

	private int $significand;
	private int $exponent;

	public function __construct(int $significand, int $exponent) {
		$this->significand = $significand;
		$this->exponent = $exponent;
	}

	public function significand(): int {
		return $this->significand;
	}

	public function exponent(): int {
		return $this->exponent;
	}

	public function asDecimal(): DecimalInterface {
		return $this;
	}
}
