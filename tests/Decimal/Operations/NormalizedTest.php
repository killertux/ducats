<?php

namespace Decimal\Operations;

use Ducats\Decimal\Decimal;
use Ducats\Decimal\Operations\Normalized;
use PHPUnit\Framework\TestCase;

class NormalizedTest extends TestCase {

	public static function dataProviderForTestNormalize(): \Generator {
		yield [new Decimal(7323500000, 12), new Decimal(73235, 17)];
		yield [new Decimal(100, 2), new Decimal(1, 4)];
		yield [new Decimal(1, 5), new Decimal(1, 5)];
		yield [new Decimal(0, 10), new Decimal(0, 0)];
	}

	/** @dataProvider dataProviderForTestNormalize */
	public function testNormalize(Decimal $decimal, Decimal $expected_decimal) {
		$normalized_decimal = (new Normalized($decimal))->asDecimal();
		$this->assertEquals($expected_decimal->exponent(), $normalized_decimal->exponent());
		$this->assertEquals($expected_decimal->significand(), $normalized_decimal->significand());
	}
}
