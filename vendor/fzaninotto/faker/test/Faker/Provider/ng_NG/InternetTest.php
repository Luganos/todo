<?php

namespace Faker\Test\Provider\ng_NG;

use Faker\Generator;
use Faker\Provider\ng_NG\Person;
use Faker\Provider\ng_NG\Internet;

class InternetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Generator
     */
    private $faker;

    public function setUp()
    {
        $faker = new Generator();
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new Internet($faker));
        $this->faker = $faker;
    }

    public function testEmailIsValid()
    {
        $email = $this->faker->email();
        $this->assertNotFalse(filter_var($email, FILTER_VALIDATE_EMAIL));
        $this->assertNotEmpty($email);
        $this->assertInternalType('string', $email);
    }
}
