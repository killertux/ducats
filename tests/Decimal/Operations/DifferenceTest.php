<?php

namespace Decimal\Operations;

use Ducats\Decimal\Operations\Difference;
use Ducats\Decimal\From\StringAsDecimal;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class DifferenceTest extends TestCase {

	public static function dataProviderForTestDifference(): \Generator {
		yield ['4.12', '3.12', '1'];
		yield ['14.12', '13.12', '1'];
		yield ['4021.12', '33.0012', '3988.1188'];
		yield ['-0.012', '2.00312', '-2.01512'];
		yield ['44.77', '-100.33', '145.1'];
		yield ['1.0e10', '2.3e-7', '9999999999.99999977'];
		yield ['1.0e-4', '2.3e-5', '7.7e-5'];
	}

	/** @dataProvider dataProviderForTestDifference */
	public function testDifference(string $decimal_a, string $decimal_b, string $result): void {
		$sum = (new Difference(
			new StringAsDecimal($decimal_a),
			new StringAsDecimal($decimal_b)
		))->asDecimal();
		$expected_result = (new StringAsDecimal($result))->asDecimal();
		Assert::assertEquals($expected_result->significand(), $sum->significand());
		Assert::assertEquals($expected_result->exponent(), $sum->exponent());
	}
}
