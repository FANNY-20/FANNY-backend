<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Assert;

trait HasExtraAssertions
{
    public function markTestSucceeded()
    {
        $this->assertTrue(true);
    }

    public function markTestFailed()
    {
        $this->assertTrue(false);
    }

    public function assertSameCollections(Collection $first, Collection $second, $checkOrder = true)
    {
        $first->diff($second)->whenNotEmpty(static function (Collection $items) use ($second) {
            Assert::assertContains(
                $items->first(),
                $second,
                "{$items->count()} item(s) are found in first but not in second"
            );
        });
        $second->diff($first)->whenNotEmpty(static function (Collection $items) use ($first) {
            Assert::assertContains(
                $items->first(),
                $first,
                "{$items->count()} item(s) are found in second but not in first"
            );
        });
        if ($checkOrder) {
            $iterator = $second->getIterator();

            foreach ($first as $item) {
                $other = $iterator->current();
                if ($item instanceof Model) {
                    if (!$item->is($other)) {
                        Assert::assertEquals(
                            $first->values()->toArray(),
                            $second->values()->toArray(),
                            'Collections are not sorted the same way'
                        );
                    }
                } else {
                    if ($item !== $other) {
                        Assert::assertEquals(
                            $first->values()->toArray(),
                            $second->values()->toArray(),
                            'Collections are not sorted the same way'
                        );
                    }
                }

                $iterator->next();
            }
        }
    }

    public function assertSameCollectionsUnordered(Collection $first, Collection $second)
    {
        $this->assertSameCollections($first, $second, false);
    }
}
