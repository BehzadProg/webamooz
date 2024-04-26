<?php
namespace Beh7ad\User\Tests\Unit;

use Beh7ad\User\Services\VerifyCodeService;
use Tests\TestCase;

Class VerifyCodeServiceTest extends TestCase
{
    public function test_generated_code_is_6_digit()
    {
        $code = VerifyCodeService::generate();

        $this->assertIsNumeric($code , 'Generated Code is not Numeric');
        $this->assertLessThanOrEqual(999999 , $code , 'Generated Code is not Less than 999999');
        $this->assertGreaterThanOrEqual(100000 , $code , 'Generated Code is not Greater than 100000');
    }

    public function test_verify_code_can_be_cached_and_access_it_form_cache()
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1 , $code);

        $this->assertEquals($code , cache()->get('verify_code_1'));
    }
}
