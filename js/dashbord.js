document.addEventListener("DOMContentLoaded", function () {
    const uploadImage = document.getElementById("uploadImage");
    const dropArea = document.getElementById("dropArea");
    const previewImage = document.getElementById("previewImage");
    const deleteImage = document.getElementById("deleteImage");
    const editImage = document.getElementById("editImage");
    const progressBar = document.getElementById("progressBar");

    // Function to show image preview
    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            previewImage.src = event.target.result;
            previewImage.style.display = "block";
            deleteImage.style.display = "block";
            editImage.style.display = "block";
        };
        reader.readAsDataURL(file);
    }

    // Function to reset the upload area
    function resetUploadArea() {
        previewImage.src = "";
        previewImage.style.display = "none";
        deleteImage.style.display = "none";
        editImage.style.display = "none";
        uploadImage.value = "";
        progressBar.style.width = "0%";
    }

    // Drag and drop area events
    dropArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropArea.classList.add("drag-over");
    });

    dropArea.addEventListener("dragleave", (e) => {
        dropArea.classList.remove("drag-over");
    });

    dropArea.addEventListener("drop", (e) => {
        e.preventDefault();
        dropArea.classList.remove("drag-over");
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            showImagePreview(files[0]);
        }
    });

    // File input change event
    uploadImage.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file) {
            showImagePreview(file);
            uploadFile(file); // Upload file via AJAX
        }
    });

    // Delete image button
    deleteImage.addEventListener("click", (e) => {
        resetUploadArea();
    });

    // Edit image button (re-trigger the file input)
    editImage.addEventListener("click", (e) => {
        uploadImage.click();
    });

    // AJAX file upload function
    function uploadFile(file) {
        const formData = new FormData();
        formData.append("image", file);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/upload-image", true);  // Change the URL to your actual server endpoint

        // Show progress bar
        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBar.style.width = percentComplete + "%";
            }
        };

        // xhr.onload = function () {
        //     if (xhr.status == 200) {
        //         // Successfully uploaded
        //         alert("Image uploaded successfully!");
        //     } else {
        //         // Failed to upload
        //         alert("Failed to upload image.");
        //         resetUploadArea();
        //     }
        // };

        xhr.send(formData);
    }
});
