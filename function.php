<?php

$conn = mysqli_connect("localhost", "root", "", "simbs");


// fungsi untuk menampilkan data dari database
function query($query){
    global $conn;


    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}


// fungsi untuk menambahkan data ke database
function tambah_data($data){
    global $conn;

    $id_buku = $data['id_buku'];
    $nama_buku = $data['nama_buku'];
    $penulis = $data['penulis'];
    $deskripsi = $data['deskripsi'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $id_kategori = $data['id_kategori'];
    $tanggal_input = $data['tanggal_input'];

    // upload gambar
    $cover = upload_gambar($penulis, $nama_buku);  
    if( !$cover ) {
        return false;
    }


    $query = "INSERT INTO buku (nama_buku, penulis, deskripsi, harga, stok, cover, id_kategori, tanggal_input)
                  VALUES ('$nama_buku', '$penulis', '$deskripsi', '$harga', '$stok', '$cover', '$id_kategori', '$tanggal_input')
                 ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);    
}

// fungsi untuk menghapus data dari database
function hapus_data($id_buku){
    global $conn;


    $query = "DELETE FROM buku WHERE id_buku = $id_buku";


    $result = mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);    
}

// fungsi untuk mengubah data dari database
function ubah_data($data){
    global $conn;
    
    $id_buku = $data['id_buku'];
    $nama_buku = $data['nama_buku'];
    $penulis = $data['penulis'];
    $deskripsi = $data['deskripsi'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    
    // upload gambar
    $cover = upload_gambar($penulis, $nama_buku);  
    if( !$cover ) {
        return false;
    }

    $id_kategori = $data['id_kategori'];
    $tanggal_input = $data['tanggal_input'];
    

    $query = "UPDATE buku SET
                nama_buku = '$nama_buku',
                penulis = '$penulis',
                deskripsi = '$deskripsi',
                harga = '$harga',
                stok = '$stok',
                cover = '$cover',
                id_kategori = '$id_kategori',
                tanggal_input = '$tanggal_input'
              WHERE id_buku = $id_buku
             ";


     $result = mysqli_query($conn, $query);
     
     return mysqli_affected_rows($conn);
}

// fungsi untuk mencari data
function search_data($keyword){
    global $conn;


    $query = "SELECT buku.*, kategori.nama_kategori
              FROM buku
              JOIN kategori ON buku.id_kategori = kategori.id_kategori
              WHERE
              buku.id_buku LIKE '%$keyword%' OR
              buku.nama_buku LIKE '%$keyword%' OR
              buku.penulis LIKE '%$keyword%' OR
              buku.deskripsi LIKE '%$keyword%' OR
              buku.harga LIKE '%$keyword%' OR
              buku.stok LIKE '%$keyword%' OR
              buku.cover LIKE '%$keyword%' OR
              kategori.nama_kategori LIKE '%$keyword%' OR
              buku.tanggal_input LIKE '%$keyword%' 
            ";
    return query($query);
}

// fungsi untuk upload gambar
function upload_gambar($penulis, $nama_buku) {


    // setting gambar
    $namaFile = $_FILES['cover']['name'];
    $ukuranFile = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmpName = $_FILES['cover']['tmp_name'];


    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }


    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }


    // cek jika ukurannya terlalu besar
    // maks --> 5MB
    if( $ukuranFile > 5000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }


    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = $penulis . "_" . $nama_buku;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    
    move_uploaded_file($tmpName, 'dist/assets/img/' . $namaFileBaru);


    return $namaFileBaru;
}

// fungsi untuk register
function register($data){
    global $conn;


    $username = strtolower($data['username']);
    $email = $data['email'];
    $password = mysqli_real_escape_string($conn, $data['password']);
    

    // query untuk ngecek username yang diinputkan oleh user di database
    $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($query);


    if($result != NULL){
        return "Username sudah terdaftar!";
    }


    if(strlen($password)<8){
        return"password harus mengandung minimal 8 karakter!";
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password')");


    return true;
}

// fungsi untuk login
function login($data){
    global $conn;


    $username = $data['username'];
    $password = $data['password'];


    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);


    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);


        if(password_verify($password, $row['password'])){
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
           
            return true;
        } else {
           
            return "Password salah!";
        }


    }else{
        return "Username tidak terdaftar!";
    }
}

function tambah_kategori($data){
    global $conn;
    $nama = htmlspecialchars($data['nama_kategori']);
    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    return mysqli_affected_rows($conn);
}

function ubah_kategori($data){
    global $conn;
    $id = $data['id_kategori'];
    $nama = htmlspecialchars($data['nama_kategori']);
    mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori=$id");
    return mysqli_affected_rows($conn);
}

function hapus_kategori($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori=$id");
    return mysqli_affected_rows($conn);
}


?>


