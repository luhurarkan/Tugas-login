<?php 
// koneksi
$koneksi =mysqli_connect('localhost', 'root', '', 'enkripsi');

// register
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];  

    // enkripsi
    $enpass = password_hash($password, PASSWORD_DEFAULT);
    
    $insert = mysqli_query($koneksi, "INSERT INTO user (username, password) values ('$username', '$enpass')");

    if($insert){
        header('location:login.php');
    }else{
        echo '
        <script>
            alert("Registrasi gagal");
            window.location.href="register.php";
        </script>
        ';
    }
}

// verifikasi login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];     

    $cekdb = mysqli_query($koneksi, "SELECT * FROM user where username='$username'");
    $hitung = mysqli_num_rows($cekdb);
    $pw = mysqli_fetch_array($cekdb);
    $passwordsekarang = $pw['password'];

    if($hitung>0){
        if(password_verify($password, $passwordsekarang)){
            header('location:home.php');
        }else{
            echo '
            <script>
                alert("Password Anda Salah");
                window.location.href="login.php";
            </script>
            ';
        }
    }else{
        echo '
        <script>
            alert("Login gagal");
            window.location.href="login.php";
        </script>
        ';
    }
}
?>

