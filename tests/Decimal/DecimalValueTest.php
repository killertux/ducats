<?php

namespace Decimal;

use Ducats\Decimal\DecimalValue;
use Ducats\Decimal\To\DecimalAsFloat;
use PHPUnit\Framework\TestCase;

class DecimalValueTest extends TestCase {

	public function testChainOperations(): void {
		$value = DecimalValue::fromString('23.45')
			->add(DecimalValue::fromString('2'))
			->multiply(DecimalValue::fromString('0.5'))
			->divide(DecimalValue::fromString('10'))
			->asDecimal();
		$this->assertEquals('1.2725', (new DecimalAsFloat($value))->float());
	}
}
