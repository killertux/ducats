<?php

namespace Decimal\Operations;

use Ducats\Decimal\Operations\Quotient;
use Ducats\Decimal\From\StringAsDecimal;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class QuotientTest extends TestCase {

	public static function dataProviderForTestQuotient(): \Generator {
		yield ['3', '10', '0.3'];
		yield ['5', '2', '2.5'];
	}

	/** @dataProvider dataProviderForTestQuotient */
	public function testQuotient(string $dividend, string $divisor, string $result): void {
		$quotient = (new Quotient(
			new StringAsDecimal($dividend),
			new StringAsDecimal($divisor),
		))->asDecimal();
		$result = (new StringAsDecimal($result))->asDecimal();
		Assert::assertEquals($result->significand(), $quotient->significand());
		Assert::assertEquals($result->exponent(), $quotient->exponent());
	}
}
