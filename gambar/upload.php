<?php 
$image = '';

if(isset($_FILES['file']['name']))
{
    $image_name = $_FILES['file']['name'];
    $valid_extensions = array("jpg","jpeg","png");
    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
    if (in_array($extension, $valid_extensions))
    {
        $rename = time() . '.'. $extension;
        $upload_path = 'upload/' . $rename;
      if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)) 
      {
        $conn = new mysqli("localhost","root","","upload");
        $sql = "INSERT INTO gambar (keterangan, file_name) VALUES ('','$rename')";
        
        $conn->query($sql);
        $conn->close();

        $massage = 'Image Upload';
        $image = $upload_path;
      }
      else
      {
        $massage = 'there is error while uploading image';
      } 
    }
    else
    {
        $massage = 'only jpg,jpeg and png image allowed to upload';
    }
    }
    else
    {
        $massage = 'select image';
    }

    $output = array(
        'massage' => $massage,
        'image' => $image
    );
    echo json_encode($output);
?>