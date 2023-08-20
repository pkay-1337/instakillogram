<?php echo exec('whoami'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>File Upload Example</title>
    <style>
    /* Style for the file input container */
    .custom-file-label {
        display: inline-block;
        padding: 6px 12px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Hide the actual file input */
    #fileInput {
        display: none;
    }

    /* Style for the submit button (you can customize it as needed) */
    button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>
</head>
<body>

    <form id="fileUploadForm">
        <label for="fileInput" class="custom-file-label">
            <img src="" alt="select file"></img>
        </label>
        <input type="file" id="fileInput" />
        <button type="button" onclick="submitFile()">Upload File</button>
    </form>
    <script>
        function submitFile() {
            var fileInput = document.getElementById("fileInput");
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append("file", file);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "upload.php", true);
            xhr.onload = function () {
                // Handle the response from the server if needed
                if (xhr.status === 200) {
                    alert("File uploaded successfully!");
                } else {
                    alert("Failed to upload the file.");
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>

