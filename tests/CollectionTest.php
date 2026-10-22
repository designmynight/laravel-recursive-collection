<?php
namespace DesignMyNight\Laravel\Tests;

use DesignMyNight\Laravel\Tests\TestCase;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use stdClass;

class CollectionTest extends TestCase
{
    #[Test]
    public function it_converts_nested_arrays_into_collections()
    {
        $collection = (new Collection([
            [1, 2, 3],
        ]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection[0]);
    }

    #[Test]
    public function it_converts_deep_nested_arrays_into_collections()
    {
        $collection = (new Collection([
            [
                [1, 2, 3],
            ],
        ]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection[0][0]);
    }

    #[Test]
    public function it_converts_nested_associative_arrays_into_collections()
    {
        $collection = (new Collection([
            'a' => [1, 2, 3],
        ]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection['a']);
    }

    #[Test]
    public function it_converts_deep_nested_associative_arrays_into_collections()
    {
        $collection = (new Collection([
            'a' => [
                'a' => [1, 2, 3],
            ],
        ]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection['a']['a']);
    }

    #[Test]
    public function it_keeps_nested_array_values_and_keys()
    {
        $data = [
            'a' => [1, 2, ['b' => 'c']],
            'd' => [],
            5 => ['e' => ['f' => null]],
        ];

        $collection = (new Collection($data))->recursive();

        $this->assertInstanceOf(Collection::class, $collection['a'][2]);
        $this->assertInstanceOf(Collection::class, $collection['d']);
        $this->assertInstanceOf(Collection::class, $collection[5]['e']);
        $this->assertSame($data, $collection->toArray());
    }

    #[Test]
    public function it_leaves_scalars_and_nulls_unchanged()
    {
        $data = ['int' => 1, 'float' => 1.5, 'string' => 'a', 'bool' => false, 'null' => null];

        $collection = (new Collection([$data, ...array_values($data)]))->recursive();

        $this->assertSame($data, $collection[0]->all());
        $this->assertSame(array_values($data), $collection->slice(1)->values()->all());
    }

    #[Test]
    public function it_converts_nested_objects_into_collections()
    {
        $object = new stdClass();
        $object->name = 'Venue A';
        $object->address = new stdClass();
        $object->address->postcode = 'M1 1AA';

        $collection = (new Collection(['venue' => $object]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection['venue']);
        $this->assertInstanceOf(Collection::class, $collection['venue']['address']);
        $this->assertSame(['name' => 'Venue A', 'address' => ['postcode' => 'M1 1AA']], $collection['venue']->toArray());
    }

    #[Test]
    public function it_converts_nested_collections_recursively()
    {
        $collection = (new Collection([new Collection([[1, 2]])]))->recursive();

        $this->assertInstanceOf(Collection::class, $collection[0][0]);
        $this->assertSame([[[1, 2]]], $collection->toArray());
    }

    #[Test]
    public function it_is_available_through_the_collect_helper()
    {
        $this->assertInstanceOf(Collection::class, collect([[1]])->recursive()[0]);
    }
}
