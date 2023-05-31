<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twój wskaźnik BMI</title>
    <link rel="stylesheet" href="styl4.css">
</head>
<body>
    <section class="baner">
        <h2>Oblicz wskaźnik BMI</h2>
    </section>
    <section class="logo">
        <img src="wzor.png" alt="liczymy BMI">
    </section>
    <section class="lewy">
        <img src="rys1.png" alt="zrzuć kalorie!">
    </section>
    <section class="prawy">
        <h1>Podaj dane</h1>
        <form method="POST">
            <label for="waga">Waga:</label>
            <input type="number" name="waga" id="waga"><br>
            <label for="wzrost">Wzrost[cm]:</label>
            <input type="number" name="wzrost" id="wzrost"><br>
            <input type="submit" value="Licz BMI i zapisz wynik">
            <br><br>
            <?php
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $polaczenie=mysqli_connect('localhost','root','','egzamin');
                $waga=$_POST['waga'];
                $wzrost=$_POST['wzrost'];
                if($waga AND $wzrost){
                    $BMI=$waga/$wzrost**2;
                    $BMI=$BMI*10000;
                    echo "Twoja waga: ".$waga."; Twój wzrost: ".$wzrost."<br>";
                    echo "BMI wynosi: ".$BMI;
                }
                if($BMI<19){
                    $wartosc=1;
                }elseif($BMI>=19){
                    $wartosc=2;
                }elseif($BMI>=26){
                    $wartosc=3;
                }elseif($BMI>=31){
                    $wartosc=4;
                }
                $zapytanie="INSERT wynik VALUES (NULL,$wartosc,'".date('Y-m-d')."',".$BMI." )";
                $wynik=mysqli_query($polaczenie,$zapytanie);
                mysqli_close($polaczenie);
            }
            
            ?>
        </form>
    </section>
    <main>
        <table>
            <thead>
                <tr>
                    <th>lp.</th>
                    <th>Interpretacja</th>
                    <th>zaczyna się od ...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $polaczenie=mysqli_connect('localhost','root','','egzamin');
                $zapytanie2="SELECT id, informacja, wart_min FROM bmi";
                $wynik=mysqli_query($polaczenie,$zapytanie2);
                while($wiersz=mysqli_fetch_array($wynik)){
                    echo "<tr><td>".$wiersz['id']."</td><td>".$wiersz['informacja']."</td><td>".$wiersz['wart_min']."</td></tr>";
                }
                mysqli_close($polaczenie);
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        Autor: Przemek <a href="kw2.jpg">Wynik działania kwerendy 2</a>
    </footer>
    
</body>
</html>