<?php

namespace Ducats\Decimal\Operations;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\Decimal;
use Ducats\Decimal\DecimalInterface;

class Normalized implements AsDecimal {

	private AsDecimal $as_decimal;

	public function __construct(AsDecimal $as_decimal) {
		$this->as_decimal = $as_decimal;
	}

	public function asDecimal(): DecimalInterface {
		$decimal = $this->as_decimal->asDecimal();
		if ($decimal->significand() === 0) {
			return new Decimal(0, 0);
		}
		[$normalized_significand, $normalized_exponent] = self::normalize($decimal->significand(), $decimal->exponent());
		return new Decimal(
			$normalized_significand,
			$normalized_exponent
		);
	}

	private static function normalize(int $significand, int $exponent): array {
		if ($significand % 10 === 0) {
			return self::normalize($significand / 10, $exponent + 1);
		}
		return [$significand, $exponent];
	}

}
