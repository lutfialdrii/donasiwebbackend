<?php

include 'connection.php';

try {
    if($_POST) {
        $donatur = $_POST["donatur"];
        $tanggal = $_POST["tanggal"];
        $jumlah = $_POST["jumlah"];

        $statement = $conn->prepare("INSERT INTO donasi (donatur, tanggal, jumlah) VALUES (:donatur, :tanggal, :jumlah)");
        $statement->bindParam(':donatur', $donatur);
        $statement->bindParam(':tanggal', $tanggal);
        $statement->bindParam(':jumlah', $jumlah);

        if(isset($_FILES['bukti']['name'])){
            $image_name = $_FILES['bukti']['name'];
            $extension_file = ["jpg", "png", "jpeg"];
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);

            if (in_array($extension, $extension_file)){
                $upload_path = 'upload/' . $image_name;
                echo $_FILES['bukti']['tmp_name'];

                if(move_uploaded_file($_FILES['bukti']['tmp_name'], $upload_path)){
                    $message = "berhasil";
                    $image = "http://localhost/donasi/".$upload_path;

                    $statement = $conn->prepare("INSERT INTO `donasi`(`donatur`, `tanggal`, `jumlah`, `bukti`) VALUES (:donatur,:tanggal,:jumlah,:bukti)");
                    $statement->bindParam(':bukti', $image);
                    $statement->bindParam(':donatur', $donatur);
                    $statement->bindParam(':tanggal', $tanggal);
                    $statement->bindParam(':jumlah', $jumlah);
                } else {
                    $message = "Terjadi kesalahan saat mengupload gambar";
                }
            } else {
                $message = "Hanya diperbolehkan file yang berformat .jpg, .jpeg dan .png ";
                $response["message"] = $message;
                $json = json_encode($response, JSON_PRETTY_PRINT);

                echo $json;
                die();
            }
        }

        $statement->execute();

        $response["status"] = 200;
        $response["message"] = "Data berhasil di record!";
        $response["image"] = $image;

    }
} catch (PDOException $e){
    $response["message"] = "Error $e";
}
$json = json_encode($response, JSON_PRETTY_PRINT);

//print json
echo $json;



