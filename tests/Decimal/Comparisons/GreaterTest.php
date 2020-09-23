<?php

namespace Decimal\Comparisons;

use Ducats\Decimal\Comparisons\Greater;
use Ducats\Decimal\From\StringAsDecimal;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class GreaterTest extends TestCase {

	public static function dataProviderForTestCompare(): \Generator {
		yield ['1.22', '1.23', false];
		yield ['1.22', '1.22', false];
		yield ['1.22', '1.21', true];
		yield ['1233', '-123.32', true];
		yield ['4.2e1', '4.2e2', false];
	}

	/** @dataProvider dataProviderForTestCompare */
	public function testCompare(string $decimal_a, string $decimal_b, bool $result): void {
		$greater = (new Greater(
			new StringAsDecimal($decimal_a),
			new StringAsDecimal($decimal_b)
		))->compare();
		Assert::assertEquals($result, $greater);
	}
}
