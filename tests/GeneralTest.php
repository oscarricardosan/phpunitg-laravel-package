<?php

namespace Oscarricardosan\PhpunitgLaravel\Tests;


class GeneralTest extends \Tests\BaseTest
{
    /**
     * @test
     */
    public function is_failing_without_token()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('PhpunitG.GetTests')) ;
        $response->assertStatus(403);
    }
    /**
     * @test
     */
    public function is_get_tests_working()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('PhpunitG.GetTests', [
            'token'=> env('PHPUNITG_TOKEN'),
        ])) ;
        $this->assertTrue(is_array($response->json()));

        foreach ($response->json()['tests'] as $test){
            $response->assertJsonStructure([
                'class', 'path', 'methods', 'tag'
            ], $test);
            $this->assertTrue(is_array($test['methods']));
        }
    }


}