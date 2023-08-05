<!DOCTYPE html>
<html>
<head>
    <title>Uploaded File Icon</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="file-icon">
    
        <?php
            // Icons add Area 
        if ($_FILES["fileToUpload"]["error"] === 0) {
            $fileType = $_FILES["fileToUpload"]["type"];
            $fileIcon = "add.png"; // Default icon

            // Map file extensions to their corresponding icons
            $iconMappings = array(
                "image/jpeg" => "image.jpg",
                "image/png" => "png.png",
                "application/pdf" => "pdf.png",
                "application/x-zip-compressed" => "zip.png",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document" => "docx.png",
                // Add more mappings as needed
            );

            if (isset($iconMappings[$fileType])) {
                $fileIcon = $iconMappings[$fileType];
            }
           
        } else {
            echo "File upload failed.";
        }
        // Icons add End 
        // File Size Covert
        $file = $_FILES['fileToUpload']['tmp_name'];

        function filesize_formatted($file)
        {
            $bytes = filesize($file);
            if ($bytes >= 1073741824) {
                return number_format($bytes / 1073741824, 2) . ' GB';
            } elseif ($bytes >= 1048576) {
                return number_format($bytes / 1048576, 2) . ' MB';
            } elseif ($bytes >= 1024) {
                return number_format($bytes / 1024, 2) . ' KB';
            } elseif ($bytes > 1) {
                return $bytes . ' bytes';
            } elseif ($bytes == 1) {
                return '1 byte';
            } else {
                return '0 bytes';
            }
        }



        $uniqueName = $_FILES['fileToUpload']['name'];
        $extension = pathinfo($uniqueName, PATHINFO_EXTENSION);
        $timestamp = time();

        $newFileName = pathinfo($uniqueName, PATHINFO_FILENAME) . '_' . $timestamp . '.' . $extension;


        // print_r($_FILES);
        ?>
        <table border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Icons</th>
                <th>Name</th>
                <th>Unique Name</th>
                <th>Type</th>
                <th>Tmp_Name</th>
                <th>Size</th>
            </tr>
        </thead>
            <tr>
                <td><?php echo '<img src="icons/' . $fileIcon . '" alt="File Icon">' ;?></td>
                <td><?php echo $_FILES['fileToUpload']['name']; ?></td>
                <td><?php echo $newFileName; ?></td>
                <td><?php echo $_FILES['fileToUpload']['type']; ?></td>
                <td><?php echo $_FILES['fileToUpload']['tmp_name']; ?></td>
                <td><?php echo filesize_formatted($file); ?></td>
            </tr>
        </table>
        <a href="./index.html">Go Back</a>
    </div>
</body>
</html>
