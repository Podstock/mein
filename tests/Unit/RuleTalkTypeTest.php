<?php

namespace Tests\Unit;

use App\Rules\TalkType;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;


class RuleTalkTypeTest extends TestCase
{
    public function test_rule_talk_type_success()
    {
        $rules = [
            'type' => [new TalkType]
        ];
        
        $data = [
            'type' => 1
        ];
        
        $this->assertTrue(Validator::make($data, $rules)->passes());
    }
    
    public function test_rule_talk_type_fails()
    {
        $rules = [
            'type' => [new TalkType]
        ];
        
        $data = [
            'type' => 100
        ];
        
        $this->assertFalse(Validator::make($data, $rules)->passes());
    }
}
