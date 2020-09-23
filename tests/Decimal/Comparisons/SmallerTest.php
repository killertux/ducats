<?php

namespace Decimal\Comparisons;

use Ducats\Decimal\Comparisons\Smaller;
use Ducats\Decimal\From\StringAsDecimal;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class SmallerTest extends TestCase {
	public static function dataProviderForTestCompare(): \Generator {
		yield ['1.22', '1.23', true];
		yield ['1.22', '1.22', false];
		yield ['1.22', '1.21', false];
		yield ['1233', '-123.32', false];
		yield ['4.2e1', '4.2e2', true];
	}

	/** @dataProvider dataProviderForTestCompare */
	public function testCompare(string $decimal_a, string $decimal_b, bool $result): void {
		$greater = (new Smaller(
			new StringAsDecimal($decimal_a),
			new StringAsDecimal($decimal_b)
		))->compare();
		Assert::assertEquals($result, $greater);
	}
}
