<?php

namespace Decimal\Operations;

use Ducats\Decimal\AsDecimal;
use Ducats\Decimal\Operations\Sum;
use Ducats\Decimal\From\StringAsDecimal;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class SumTest extends TestCase {

	public static function dataProviderForTestSum(): \Generator {
		yield ['4.12', '3.12', '7.24'];
		yield ['4021.12', '33.0012', '4054.1212'];
		yield ['-0.012', '2.00312', '1.99112'];
		yield ['1.0e10', '2.3e-7', '10000000000.00000023'];
		yield ['1.0e-4', '2.3e-5', '1.23e-4'];
		yield ['4.5', '3.5', '8'];
	}

	/** @dataProvider dataProviderForTestSum */
	public function testSum(string $decimal_a, string $decimal_b, string $result): void {
		$sum = (new Sum(
			new StringAsDecimal($decimal_a),
			new StringAsDecimal($decimal_b)
		))->asDecimal();
		$expected_result = (new StringAsDecimal($result))->asDecimal();
		Assert::assertEquals($expected_result->significand(), $sum->significand());
		Assert::assertEquals($expected_result->exponent(), $sum->exponent());
	}
}
