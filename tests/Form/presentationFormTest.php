<?php
// tests/Form/ProductsFormTest.php
namespace App\Tests\Form;

use App\Entity\Presentation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PresentationFormTest extends KernelTestCase
{
    public function testNewPresentation()
    {
        $presentation = (new Presentation())
            ->setTitleLeft('<h1>')
            ->setTextRight('<h1>')
            ->setTitleRight('<h1>')
            ->setTextLeft('<h1>');

        self::bootKernel();
        $error = self::$container->get('validator')->validate($presentation);
        $this->assertCount(0, $error);
    }
}
