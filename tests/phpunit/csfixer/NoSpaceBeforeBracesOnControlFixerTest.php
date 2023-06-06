<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
 */

declare(strict_types=1);

namespace pocketmine\csfixer;

class NoSpaceBeforeBracesOnControlFixerTest extends AbstractFixerTestCase {
	/**
	 * @dataProvider dataProvider
	 */
	public function testFix(string $expected, string $input) : void {
		$this->doTest($expected, $input);
	}

	public static function dataProvider() : iterable {
		yield 'simple space' => [
			"<?php if(true){\n\treturn;\n}",
			"<?php if(true) {\n\treturn;\n}"
		];

		yield 'double space' => [
			"<?php if(true){\n\treturn;\n}",
			"<?php if(true)  {\n\treturn;\n}"
		];

		yield 'simple tab' => [
			"<?php if(true){\n\treturn;\n}",
			"<?php if(true)	{\n\treturn;\n}"
		];

		yield 'double tab' => [
			"<?php if(true){\n\treturn;\n}",
			"<?php if(true)		{\n\treturn;\n}"
		];

		yield 'simple tab and space' => [
			"<?php if(true){\n\treturn;\n}",
			"<?php if(true) 	{\n\treturn;\n}"
		];

		yield 'simple space with return type' => [
			"<?php function test(\$test) : void{\n\treturn;\n}",
			"<?php function test(\$test) : void {\n\treturn;\n}"
		];

		yield 'double space with return type' => [
			"<?php function test(\$test) : void{\n\treturn;\n}",
			"<?php function test(\$test) : void  {\n\treturn;\n}"
		];

		yield 'with multi condition' => [
			"<?php if(1 === 1 or Exception::class === Exception::class){\n\treturn;\n}",
			"<?php if(1 === 1 or Exception::class === Exception::class) {\n\treturn;\n}"
		];

		yield 'with complex condition containing parenthesis' => [
			"<?php if((1 === 1 or Exception::class === Exception::class) and (1 === 1 or Exception::class === Exception::class)){\n\treturn;\n}",
			"<?php if((1 === 1 or Exception::class === Exception::class) and (1 === 1 or Exception::class === Exception::class)) {\n\treturn;\n}"
		];

		yield 'for statement' => [
			"<?php for(\$i = 0; \$i < 10; \$i++){\n\treturn;\n}",
			"<?php for(\$i = 0; \$i < 10; \$i++) {\n\treturn;\n}"
		];

		yield 'foreach statement' => [
			"<?php foreach(\$array as \$key => \$value){\n\treturn;\n}",
			"<?php foreach(\$array as \$key => \$value) {\n\treturn;\n}"
		];

		yield 'while statement' => [
			"<?php while(\$i < 10){\n\treturn;\n}",
			"<?php while(\$i < 10) {\n\treturn;\n}"
		];
	}
}
