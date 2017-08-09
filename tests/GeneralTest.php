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

    /**
     * @test
     */
    public function is_run_test_working()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('PhpunitG.RunMethod', [
            'token'=> env('PHPUNITG_TOKEN'),
            'method'=> 'Tests\Unit\General\DashboardTest::is_index_working',
        ])) ;
        $this->assertTrue($response->json()['success']);

        $response->assertJsonStructure([
            'success', 'message'
        ], $response->json());
    }

    /**
     * @test
     */
    public function is_failing_if_test_name_is_incorrect()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('PhpunitG.RunMethod', [
            'token'=> env('PHPUNITG_TOKEN'),
            'method'=> 'Tests\Unit\General\DashboardTest::doesnt_exists',
        ])) ;
        $this->assertFalse($response->json()['success']);

        $response->assertJsonStructure([
            'success', 'message'
        ], $response->json());
    }


}