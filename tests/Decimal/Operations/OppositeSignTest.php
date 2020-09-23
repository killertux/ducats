<?php

namespace Decimal\Operations;

use Ducats\Decimal\Operations\OppositeSign;
use Ducats\Decimal\From\StringAsDecimal;
use PHPUnit\Framework\TestCase;

class OppositeSignTest extends TestCase {

	public function testInvertSignal() {
		$decimal_a = new StringAsDecimal('3.45');
		$expected_opposite_a = new StringAsDecimal('-3.45');
		$decimal_b = new StringAsDecimal('-6.22');
		$expected_opposite_b = new StringAsDecimal('6.22');

		$opposite_a = (new OppositeSign($decimal_a));
		$opposite_b = (new OppositeSign($decimal_b));

		$this->assertEquals($opposite_a->asDecimal(), $expected_opposite_a->asDecimal());
		$this->assertEquals($opposite_b->asDecimal(), $expected_opposite_b->asDecimal());
	}
}
