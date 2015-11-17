<?php

use ZBateson\MailMimeParser\Header\Consumer\ConsumerService;
use ZBateson\MailMimeParser\Header\Part\PartFactory;
use ZBateson\MailMimeParser\Header\Consumer\QuotedStringConsumer;

/**
 * Description of QuotedStringConsumerTest
 *
 * @group Consumers
 * @group QuotedStringConsumer
 * @author Zaahid Bateson
 */
class QuotedStringConsumerTest extends PHPUnit_Framework_TestCase
{
    private $quotedStringConsumer;
    
    public function setUp()
    {
        $pf = new PartFactory();
        $cs = new ConsumerService($pf);
        $this->quotedStringConsumer = QuotedStringConsumer::getInstance($cs, $pf);
    }
    
    public function tearDown()
    {
        unset($this->quotedStringConsumer);
    }
    
    public function testConsumeTokens()
    {
        $value = 'Will end at " quote';
        
        $ret = $this->quotedStringConsumer->__invoke($value);
        $this->assertNotEmpty($ret);
        $this->assertCount(1, $ret);
        $this->assertEquals('Will end at ', $ret[0]);
    }
}