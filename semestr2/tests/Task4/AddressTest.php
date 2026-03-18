<?php

declare(strict_types=1);

namespace Tests\Task4;

use App\Task4\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testFormatsFullAddressCorrectly(): void
    {
        $address = new Address('Sienkiewicza 10', 'Warszawa', '00-015');
        $this->assertSame('Sienkiewicza 10, 00-015 Warszawa', $address->getFullAddress());
    }
}
