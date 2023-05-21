<?php

include 'connection.php';

try {
    if($_POST) {
        $id = $_POST["id"];
        $donatur = $_POST["donatur"];
        $tanggal = $_POST["tanggal"];
        $jumlah = $_POST["jumlah"];
        $bukti= $_POST["bukti"];

        $statement = $conn->prepare("SELECT * FROM donasi WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetch();


        if($result){
            $statement = $conn->prepare("UPDATE donasi SET donatur = :donatur, tanggal = :tanggal, jumlah = :jumlah WHERE id = :id");

            $statement->bindParam(':id', $id);
            $statement->bindParam(':donatur', $donatur);
            $statement->bindParam(':tanggal', $tanggal);
            $statement->bindParam(':jumlah', $jumlah);

            if(isset($_FILES['bukti']['name'])){
                $image_name = $_FILES['bukti']['name'];
                $extension_file = ["jpg", "png", "jpeg"];
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);

                if (in_array($extension, $extension_file)){
                    $upload_path = 'upload/' . $image_name;

                    if(move_uploaded_file($_FILES['bukti']['tmp_name'], $upload_path)){
                        $message = "berhasil";
                        $image = "http://localhost/donasi/".$upload_path;

                        $statement = $conn->prepare("UPDATE donasi SET donatur = :donatur, tanggal = :tanggal, jumlah = :jumlah, bukti = :bukti, UPDATED_AT = now() WHERE id = :id");

                        $statement->bindParam(':id', $id);
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
            $response["message"] = "Data berhasil di ubah!";
        } else {
            $response["message"] = "Data tidak ditemukan!";
        }

    }
} catch(PDOException $e) {
    $response["message"] = "Error . $e";
}
$json = json_encode($response, JSON_PRETTY_PRINT);

//print json
echo $json;