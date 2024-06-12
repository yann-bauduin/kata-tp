
<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlPagesConverter;

class HtmlPagesConverterTest extends TestCase
{
    private $testFile;

    protected function setUp(): void
    {
        $this->testFile = tempnam(sys_get_temp_dir(), 'testfile');
        $content = "Page 1 content\nPAGE_BREAK\nPage 2 content\nPAGE_BREAK\nPage 3 content";
        file_put_contents($this->testFile, $content);
    }

    protected function tearDown(): void
    {
        unlink($this->testFile);
    }

    public function testGetFileName(): void
    {
        $converter = new HtmlPagesConverter($this->testFile);
        $this->assertSame($this->testFile, $converter->getFileName());
    }

    public function testGetHtmlPage(): void
    {
        $converter = new HtmlPagesConverter($this->testFile);

        $expectedPage1 = 'Page 1 content<br />';
        $this->assertSame($expectedPage1, $converter->getHtmlPage(0));

        $expectedPage2 = 'Page 2 content<br />';
        $this->assertSame($expectedPage2, $converter->getHtmlPage(1));

        $expectedPage3 = 'Page 3 content<br />';
        $this->assertSame($expectedPage3, $converter->getHtmlPage(2));
    }

    public function testPageOutOfRange(): void
    {
        $converter = new HtmlPagesConverter($this->testFile);

        $this->expectException(\OutOfBoundsException::class);
        $converter->getHtmlPage(3);
    }
}
