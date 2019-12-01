<?php
function setupkey() //proses pengacakan kunci di SBox
{
echo "<br>";
$kce = $_GET["kcenkripsi"];
echo "Kunci enkripsi = $kce";
echo "<br>";
 for($i=0;$i<strlen($kce);$i++)
 {
 $key[$i]=ord($kce[$i]); //rubah ASCII ke desimal
 //echo "Hasil ke Desimal [$i]";
 //echo $key[$i];
 //echo "<br>";
 }
 global $m; //definisi variabel m
 $m=array(); //variabel m dijadikan array
 echo "<br>";
 // buat encrpyt
 for($i=0;$i<256;$i++){
 $m[$i] = $i;
 //echo "Hasil perulangan for untuk varibel m [$i]";
 //echo $m[$i];
 //echo "<br>";
}
 $j = $k = 0;
 for($i=0;$i<256;$i++)
 {
 $a = $m[$i];
 //echo "Hasil perulangan for untuk variabel a = m [$i]";
 //echo $a[$i];
 //echo "<br>";
 $j = ($j + $m[$i] + $key[$k]) % 256;
 //echo "Hasil perulangan for untuk proses enkripsi [$i]";
 //echo $j[$i];
 //echo "<br>";
 $m[$i] = $m[$j];
 //echo "Hasil perulangan for untuk variabel mi = mj [$i]";
 //echo $m[$i];
 //echo "<br>";
 $m[$j] = $a;
 //echo "Hasil perulangan for untuk variabel mj = a [$i]";
 //echo $m[$i];
 //echo "<br>";

 $k++;
 if($k>15)
 {
 $k=0;
 }
 }
} //akhir function

function crypt2($inp)
{
 global $m; //definisi variabel m
 $x=0;$y=0; //definisi variabel x dan y diberi nilai 0
 $bb='';
 $x = ($x+1) % 256;
 echo "Hasil penjumlahan dan modulo thdp var x :";
 echo $x;
 echo "<br>";

 $a = $m[$x];
 echo "Hasil fungsi m(x) ";
 echo $a;
 echo "<br>";

 $y = ($y+$a) % 256;
 echo "Hasil penjumlahan dan modulo thdp var y + a : ";
 echo $y;
 echo "<br>";

 $m[$x] = $b = $m[$y];
 echo "Hasil fungsi m(x) = b = m(y): ";
 echo $m[$x];
 echo "<br>";

 $m[$y] = $a;
 echo "Hasil fungsi m(y): ";
 echo $m[$y];
 echo "<br>";

 //proses XOR antara plaintext dengan kunci
 //dengan $inp sebagai plaintext
 //dan $m sebagai kunci
 $bb= ($inp^$m[($a+$b) % 256]) % 256;
 echo "Hasil deskripsi dalam varivel bb :";
 echo $bb;
 echo "<br>";
 return $bb;
 echo "return bb :";
 echo $bb;
 echo "<br>";
}
$kalimat = $_GET["kata"];
 //echo "Hasil memanggil varibel kalimat :";
 //echo $kalimat;
 //echo "<br>";
setupkey(); //memanggil fungsi setupkey
 for($i=0;$i<strlen($kalimat);$i++)
 {
 $kode[$i]=ord($kalimat[$i]); //rubah ASCII ke desimal
 //echo "Hasil ke desimal [$i] :";
 //echo $kode[$i];
 //echo "<br>";

 $b[$i]=crypt2($kode[$i]); //proses enkripsi RC4
 //echo "Hasil ke proses enkripsi RC4 [$i]:";
 //echo $b[$i];
 //echo "<br>";

 $c[$i]=chr($b[$i]); //rubah desimal ke ASCII
 //echo "Hasil ke ASCII [$i]:";
 //echo $c[$i];
 //echo "<br>";

 }
 echo "kalimat ASLI : ";
 for($i=0;$i<strlen($kalimat);$i++)
 {
 echo $kalimat[$i];
 }
 echo "<br>";
 echo "hasil enkripsi =";
 $hsl = '';
 for ($i=0;$i<strlen($kalimat);$i++)
 {
 echo $c[$i];
 $hsl = $hsl . $c[$i];
 }
 echo "<br>";
 //simpan data di file
 $fp = fopen ("enkripsirc4.txt","w");
 fputs ($fp,$hsl);
 fclose($fp);
 ?>