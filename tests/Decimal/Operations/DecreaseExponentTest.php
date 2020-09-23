<?php

namespace Decimal\Operations;

use Ducats\Decimal\Decimal;
use Ducats\Decimal\Operations\DecreaseExponent;
use PHPUnit\Framework\TestCase;

class DecreaseExponentTest extends TestCase {

	public static function dataProviderForTestDecreaseExponent(): \Generator {
		yield [new Decimal(1, 2), 1, new Decimal(10, 1)];
		yield [new Decimal(3123, 5), -1, new Decimal(3123000000, -1)];
	}

	/** @dataProvider dataProviderForTestDecreaseExponent */
	public function testDecreaseExponent(Decimal $decimal, int $new_exponent, Decimal $expected_decimal) {
		$new_decimal = (new DecreaseExponent($decimal, $new_exponent))->asDecimal();
		$this->assertEquals($expected_decimal->significand(), $new_decimal->significand());
		$this->assertEquals($expected_decimal->exponent(), $new_decimal->exponent());
	}

	public function testTryIncreasingExponent_ShouldThrowException(): void {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('New exponent should be smaller than current decimal exponent');
		(new DecreaseExponent(new Decimal(1, 1), 2))->asDecimal();
	}
}
