 <?php
use MyNamespace\OCR;
use PHPUnit\Framework\TestCase;


final class OCRTest extends TestCase
{
    public function testNumerKontaSpelniającySumeKontrolnaJestWyswietlany(): void
    {
        $kontoAscii = <<<EOT
 _     _  _  _  _  _  _  _ 
 _||_||_ |_||_| _||_||_ |_ 
 _|  | _||_||_||_ |_||_| _|
EOT;
        $numeryKontAscii = new OCR();
        $wynik = $numeryKontAscii->zmianaNumeruAsciiZTekstu($kontoAscii);
        $this->assertIsString($wynik);
        $this->assertEquals("345882865\n", $wynik);


    }

    public function testWeryfikujeMinimalnaDlugoscKonta() : void
    {   
        $kontoAscii = <<<EOT
    _  _  _  _ 
 |  _||_||_|| |
 |  _||_||_||_|
    _  _  _  _     _ 
 |  _||_||_|| | |  _|
 |  _||_||_||_| | |_ 
EOT;
        $numeryKontAscii = new OCR();
        $wyniki = $numeryKontAscii->zmianaNumeruAsciiZTekstu($kontoAscii);
        $tablicaWynikow = explode("\n", $wyniki);
        foreach($tablicaWynikow as $wynik) {
            $this->assertStringContainsString("Numer konta za krótki ", $wynik);
        }
    }

    public function testWeryfikujeMaksymalnaDlugoscKonta() : void
    {   
        $kontoAscii = <<<EOT
    _  _  _  _     _  _  _  _     _ 
 |  _||_||_|| | |  _||_||_|| | |  _|
 |  _||_||_||_| |  _||_||_||_| | |_ 
    _  _  _  _     _  _  _    
 |  _||_||_|| | |  _||_|| | | 
 |  _||_||_||_| | |_ |_||_| | 
EOT;
        $numeryKontAscii = new OCR();
        $wyniki = $numeryKontAscii->zmianaNumeruAsciiZTekstu($kontoAscii);
        $tablicaWynikow = explode("\r\n", $wyniki);
        foreach($tablicaWynikow as $wynik) {
            $this->assertMatchesRegularExpression('/Numer konta za długi \n/', $wynik);
        }
    }

    public function testNumeryKontZNieprawidlowaCyframiSaZakonczoneERR(): void
    {
        $kontoAscii = <<<EOT
 _  _  _  _     _  _  _  _ 
|_|| | _ |_ |_||_ |_||_| _|
|_||_||_  _|    _| _||_||_ 
 _  _  _  _     _  _  _  _ 
|_|| | _ |_ |_||_ |_||_| _|
|_||_||_  _|    _| _||_||_ 
EOT;
        $numeryKontAscii = new OCR();
        $wyniki = $numeryKontAscii->zmianaNumeruAsciiZTekstu($kontoAscii);
        $tablicaWynikow = explode("\r\n", $wyniki);
        foreach($tablicaWynikow as $wynik) {
            if(str_contains($wynik, "?")){
                $this->assertMatchesRegularExpression('/ERR/', $wynik);
            }
        }
    }


    public function testNumeryKontZeZmienionymiCyframiGdzieJedenNumerSpelniaSumeKontrolnaSaZakonczoneIRR(): void
    { //skorygowany numer konta zawiera dopisek IRR 
        $kontoAscii = <<<EOT
 _  _  _  _  _  _  _  _  _ 
 _||_||_ |_||_| _||_||_ |_ 
 _|  | _||_||_||_ |_||_| _|
EOT;
        $numeryKontAscii = new OCR();
        $wynik = $numeryKontAscii->zmianaNumeruAsciiZTekstu($kontoAscii);
        $tablicaWynikow = explode("\r\n", $wynik);
        foreach($tablicaWynikow as $wynik) {
                $this->assertMatchesRegularExpression('/IRR/', $wynik);
        }
    }

    public function testNumeryKontZeZmienionymiCyframiGdziePareNumerowSpelniaSumeKontrolnaSaZakonczoneAMB(): void
    {//niejednoznacznie skorygowany numer konta zawiera dopisek AMB
        $kontoAscii = <<<EOT
    _  _  _  _  _  _  _  _ 
 |  _||_||_|| | _||_  _||_ 
 |  _||_||_||_||_  _||_  _|
EOT;
        $numeryKontAscii = new OCR();
        $wynik = $numeryKontAscii->zmianaNumeruAsciiZTekstu($kontoAscii);
        $tablicaWynikow = explode("\r\n", $wynik);
        foreach($tablicaWynikow as $wynik) {
                $this->assertMatchesRegularExpression('/AMB/', $wynik);
        }
    }

}
