<?php
namespace DesignMyNight\Laravel\Tests;

use DesignMyNight\Laravel\Tests\TestCase;
use Illuminate\Support\Collection;

class CollectionTest extends TestCase
{
    /**
     * @test
     */
    public function it_converts_nested_arrays_into_collections()
    {
        $collection = (new Collection([
            [1, 2, 3],
        ]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection[0]);
    }

    /**
     * @test
     */
    public function it_converts_deep_nested_arrays_into_collections()
    {
        $collection = (new Collection([
            [
                [1, 2, 3],
            ],
        ]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection[0][0]);
    }

    /**
     * @test
     */
    public function it_converts_nested_associative_arrays_into_collections()
    {
        $collection = (new Collection([
            'a' => [1, 2, 3],
        ]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection['a']);
    }

    /**
     * @test
     */
    public function it_converts_deep_nested_associative_arrays_into_collections()
    {
        $collection = (new Collection([
            'a' => [
                'a' => [1, 2, 3],
            ],
        ]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection['a']['a']);
    }
}
