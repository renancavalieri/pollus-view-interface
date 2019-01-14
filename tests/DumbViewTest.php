<?php

use PHPUnit\Framework\TestCase;
use Pollus\ViewInterface\Tests\DumbView;

class DumbViewTest extends TestCase
{
    public function testDumbViewArrayAccess()
    {
        $view = new DumbView();
        $view["test"] = "hello world";
        $this->assertSame("hello world", $view->get("test"));
        
        $view = new DumbView();
        $view->set("test", "foo bar");
        $this->assertSame("foo bar", $view->get("test"));
        
        $view->merge(["test" => "new value"]);
        $this->assertSame("new value", $view->get("test"));
    }
}
