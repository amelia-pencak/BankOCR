 <?php 
// require_once('_liczba.php');
// $host = 'localhost';
// $db = 'ListaPobran';
// $user = 'postgres';
// $password = '1234';

// $dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$password";
// $conn = new PDO($dsn);
// $tmp = isset($_POST['plikDanych'][0]);

// $myfile = fopen("wynik.txt", "w");
// $liczbaPlikow = count(($_FILES['plikDanych']['name']));
// for ($i=0;$i<$liczbaPlikow;$i++) {
            
//     $target_dir = "./";
//     $filename = "dane".$i.".txt";
//     $newFile = $target_dir . "/". $filename;
    
//     move_uploaded_file($_FILES['plikDanych']['tmp_name'][$i], $newFile);

//     $numeryKont = file_get_contents($newFile);
//     $ocr = new OCR();
//     $wyniki = $ocr->zmianaNumeruAsciiZTekstu($numeryKont);
//     fwrite($myfile,$wyniki);
//     $wyniki = nl2br($wyniki);

//     $obecnaData =date('d-m-y');
//     $newFilename = "'".$filename."'";
//     $sql = 'INSERT INTO pobrania("dataWgrania","linkDoPliku") VALUES (\''.$obecnaData.'\' ,'.$newFilename.')';
//     try {
//         if(isset($newFilename)) {
//             $res = $conn->query($sql);
//         }
//     }
//         catch(PDOException $e) {
//     echo $e->getMessage();
//     }
// }
// fclose($myfile);

// try{
//     $sqlSave = 'SELECT * FROM "pobrania"';
//     $bazaWynikow = $conn->query($sqlSave);
//     foreach($bazaWynikow as $row){
//         echo "<br/>";
//         echo $row['dataWgrania']. ' | '. $row['linkDoPliku']. "<br/>";
//     }

// } catch(PDOException $e) {
//     echo $e->getMessage();
// }

//     echo "wynik obliczony: <br/>";
//     echo '<a href="?oknoPobraniaPliku.php" name="pobieraniePliku"> pobierz </a>';
    
    

        
// }
// $sciezkaDoPliku = 'C:\xampp\htdocs\studia\wejscie.txt';
// $sciezkaZapisu = 'C:\xampp\htdocs\studia\wynikiA.txt';
// $plikDanych = fopen($sciezkaDoPliku, 'r+');
// file_put_contents($sciezkaDoPliku, $numeryKont);

// $ocr = new OCR();
// $ocr->zmianaNumeruAscii($sciezkaDoPliku,$sciezkaZapisu);
// $plik = fopen($sciezkaZapisu, "r");

    // $wyniki = file_get_contents($sciezkaZapisu);

    // $wyniki = nl2br($wyniki);
    // $wyniki = str_replace("\n",'<br/>',$wyniki);

    // echo $wyniki;


// file_put_contents($sciezkaDoPliku, "");
// file_put_contents($sciezkaZapisu, ""); -->
