<?php

namespace Ducats\Decimal;

interface DecimalInterface extends AsDecimal {

	public function significand(): int;
	public function exponent(): int;
}
