<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #ffffff;
        }

        .container {
            text-align: center;
            width: 35%;
            height: 40%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 1px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }

        #dropZone {
            border: 2px dashed #424242;
            padding: 20px;
            cursor: pointer;
        }

        input[type="file"] {
            display: none;
        }

        button {
            margin: 10px;
            padding: 8px 16px;
            background-color: #566356;
            color: #fff;
            border: none;
            margin-top: 50px;
            margin-left: 30px;
            margin-right: 30px;
            border-radius: 4px;
            cursor: pointer;
        }

        #status {
            margin-top: 10px;
            font-weight: bold;
            color: #0000009d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload</h2>
        <div id="dropZone" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
            <p id="selectedFileText">Drag and Drop</p>
            <input type="file" id="fileInput" name="file" accept="image/*" multiple onchange="handleFileSelect();">
        </div>
        <button type="button" onclick="document.getElementById('fileInput').click();">Select Files</button>
        <button type="button" onclick="uploadFiles();">Upload Photos</button>
        <p id="status"></p>
    </div>
    <script>
        function handleFileSelect() {
            var fileInput = document.getElementById('fileInput');
            var selectedFileText = document.getElementById('selectedFileText');

            if (fileInput.files.length > 0) {
                var fileNames = Array.from(fileInput.files).map(file => file.name).join(', ');
                selectedFileText.innerHTML = 'Selected files: ' + fileNames;
            } else {
                selectedFileText.innerHTML = 'Drag and drop photos here or click to select up to 10 files.';
            }
        }

        function dragOverHandler(event) {
            event.preventDefault();
        }

        function dropHandler(event) {
            event.preventDefault();
            var fileInput = document.getElementById('fileInput');
            fileInput.files = event.dataTransfer.files;
            handleFileSelect();
        }

        function uploadFiles() {
            var fileInput = document.getElementById('fileInput');
            var status = document.getElementById('status');

            var files = fileInput.files;
            if (!files || files.length === 0) {
                alert('Please select at least one photo.');
                return;
            }

            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    status.innerHTML = data.message;
                } else {
                    status.innerHTML = data.message;
                }
            })
            .catch(error => {
                status.innerHTML = 'Photo upload failed. Please try again.';
            });
        }
    </script>
</body>
</html>

<?php
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Store/uploads/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$maxFiles = 10;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $files = $_FILES['files'];

    // Check the number of files
    if (count($files['name']) > $maxFiles) {
        die('Too many files. Please upload up to ' . $maxFiles . ' files.');
    }

    $uploadedFiles = [];

    for ($i = 0; $i < count($files['name']); $i++) {
        $file = [
            'name' => $files['name'][$i],
            'type' => $files['type'][$i],
            'tmp_name' => $files['tmp_name'][$i],
            'error' => $files['error'][$i],
            'size' => $files['size'][$i],
        ];

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Check if the file is an image and has a valid extension
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            die('Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.');
        }

        // Generate a unique filename to avoid overwriting existing files
        $filename = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $filename;

        // Debug statement
        echo 'Debug: Before move_uploaded_file<br>';

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $uploadedFiles[] = $filename;
        } else {
            // Debug statement
            echo 'Debug: Error moving uploaded file<br>';
            die(json_encode(['success' => false, 'message' => 'Error uploading files.']));
        }
    }

    echo json_encode(['success' => true, 'message' => 'Files uploaded successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
