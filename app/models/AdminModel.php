<?php
class AdminModel extends BaseModel
{
    public function moveFile($file, $id)
    {
        $targetDirectory = "public/img/$id/";

        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0755, true); // Create the target directory if it doesn't exist
        }

        $targetFile = $targetDirectory . basename($file["prod_thumbnail"]["name"]);

        if (move_uploaded_file($_FILES["prod_thumbnail"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["prod_thumbnail"]["name"]) . " has been uploaded and moved to " . $targetFile;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>