<?php

namespace Ducats\Decimal\From;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\Decimal;
use Ducats\Decimal\DecimalInterface;
use Ducats\Decimal\Operations\Normalized;

class StringAsDecimal implements AsDecimal {

	private string $number;

	public function __construct(string $number) {
		if (!is_numeric($number)) {
			throw new \InvalidArgumentException('Number must be numeric');
		}
		$this->number = $number;
	}

	public function asDecimal(): DecimalInterface {
		$is_negative = $this->number < 0;
		$parts = explode('e', $this->number);
		$number = $parts[0];
		$exponent_part = (int)($parts[1] ?? 0);
		// This approach does not seems too efficient :/
		[$number, $exponent] = self::processNumber(self::abs($number), $exponent_part);
		return (new Normalized(new Decimal(
			$number * ($is_negative ? -1 : 1),
			$exponent
		)))->asDecimal();
	}

	private static function processNumber(string $number, int $exponent_part): array {
		if ($number < 1 || self::hasDecimalPart($number)) {
			return self::processNumber(self::shiftNumberLeft($number) , $exponent_part - 1);
		}
		return [(int)$number, $exponent_part];
	}

	private static function hasDecimalPart(string $number): bool {
		$parts = explode('.', $number);
		if (!isset($parts[1]) || (int)$parts[1] === 0) {
			return false;
		}
		return true;
	}

	private static function abs(string $number): string {
		if ($number[0] === '+' || $number[0] === '-') {
			return substr($number, 1);
		}
		return $number;
	}

	private static function shiftNumberLeft(string $number): string {
		$parts = explode('.', $number);
		$integer_part = $parts[0] . $parts[1][0];
		$decimal_part = substr($parts[1], 1);
		// If there is no remaining decimal part. Is better to not even add the .0
		// This is because of shenanigans of converting this number to a int after.
		if ($decimal_part) {
			return $integer_part . '.' . $decimal_part;
		}
		return $integer_part;
	}

}
