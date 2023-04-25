<?php
class Request {
    function zwrocTabliceTmpNazwPliku($plikUrzytkownika) {//parametryzowane //
       return $_FILES[$plikUrzytkownika]['tmp_name'];
    }
   function zwrocPlik($plikUrzytkownika, $nazwa) {
       return $_FILES[$plikUrzytkownika][$nazwa];
   }
   function zwrocParametrGet($nazwaParametru) {
       return $_GET[$nazwaParametru];
   }
}