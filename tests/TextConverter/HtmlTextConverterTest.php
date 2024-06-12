<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlTextConverter;

class HtmlTextConverterTest extends TestCase
{
    private $testFile;

    protected function setUp(): void
    {
        $this->testFile = tempnam(sys_get_temp_dir(), 'testfile');
        file_put_contents($this->testFile, "Hello, World!\nThis is a test file.");
    }

    protected function tearDown(): void
    {
        unlink($this->testFile);
    }

    public function testGetFileName(): void
    {
        $converter = new HtmlTextConverter($this->testFile);
        $this->assertSame($this->testFile, $converter->getFileName());
    }

    public function testConvertToHtml(): void
    {
        $converter = new HtmlTextConverter($this->testFile);
        $expectedHtml = 'Hello, World!<br />This is a test file.<br />';
        $this->assertSame($expectedHtml, $converter->convertToHtml());
    }
}
