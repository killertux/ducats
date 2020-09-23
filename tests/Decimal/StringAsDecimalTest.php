<?php

namespace Decimal;

use Ducats\Decimal\From\StringAsDecimal;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class StringAsDecimalTest extends TestCase {

	public static function dataProviderForTestAsDecimal(): \Generator {
		///   String     Significand  Exponent
		yield ['123.42',     12342,  -2];
		yield ['-123.42',   -12342,  -2];
		yield ['-0.42',     -42,     -2];
		yield ['-.42',      -42,     -2];
		yield ['.42',        42,     -2];
		yield ['0042',       42,      0];
		yield ['0.042',      42,     -3];
		yield ['-0.000133', -133,    -6];
		yield ['1123.4e5',   11234,   4];
		yield ['.4e-5',      4,      -6];
		yield ['.0034e-5',   34,     -9];
		yield ['2.3e-7',     23,     -8];
		yield ['100000000000.0000023', 1000000000000000023, -7];
	}

	/** @dataProvider dataProviderForTestAsDecimal */
	public function testAsDecimal(string $number, int $significand, int $exponent): void {
		$string_as_decimal = new StringAsDecimal($number);
		Assert::assertEquals($significand, $string_as_decimal->asDecimal()->significand());
		Assert::assertEquals($exponent, $string_as_decimal->asDecimal()->exponent());
	}
}
