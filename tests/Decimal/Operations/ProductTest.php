<?php

namespace Decimal\Operations;

use Ducats\Decimal\Operations\Product;
use Ducats\Decimal\From\StringAsDecimal;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {

	public static function dataProviderForTestProduct(): \Generator {
		yield ['0.5', '0.5', '0.25'];
		yield ['1', '0.5', '0.5'];
		yield ['2', '5', '10'];
		yield ['-110.44', '321.21', '-35474.4324'];
		yield ['1.43e-8', '1.21e-10', '1.7303e-18'];
	}

	/** @dataProvider dataProviderForTestProduct */
	public function testProduct(string $decimal_a, string $decimal_b, string $result): void {
		$product = (new Product(
			new StringAsDecimal($decimal_a),
			new StringAsDecimal($decimal_b),
		))->asDecimal();
		$expected_result = (new StringAsDecimal($result))->asDecimal();
		Assert::assertEquals($expected_result->significand(), $product->significand());
		Assert::assertEquals($expected_result->exponent(), $product->exponent());
	}
}
