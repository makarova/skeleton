<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Tests\Acl;

use Application\Tests\ControllerTestCase;

/**
 * @package  Application\Tests\Acl
 * @author   Anton Shevchuk
 * @created  04.08.11 19:52
 */
class IndexTest extends ControllerTestCase
{
    /**
     * Dispatch default module/controller
     *
     * @todo test functionality
     */
    public function testControllerPage()
    {
        $this->setupSuperUserIdentity();

        $this->dispatchRouter('/acl/');
        $this->assertOk();

        $this->markTestIncomplete();
    }
}
