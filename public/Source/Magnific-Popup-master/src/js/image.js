function previewImage(input, previewId, removeBtnId) {
    const preview = document.getElementById(previewId);
    const removeBtn = document.getElementById(removeBtnId);
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            removeBtn.style.display = "block";
        };

        reader.readAsDataURL(file);
    }
}

function removeImage(index) {
    const preview = document.getElementById("preview" + index);
    const input = document.getElementById("image" + index);
    const removeBtn = document.getElementById("removeBtn" + index);

    // Reset the file input
    input.value = "";

    // Show placeholder image
    preview.src = "";

    // Hide remove button
    removeBtn.style.display = "none";

    // Optional: Add a hidden input to indicate deletion
    // You'll need to handle this in your controller
    if (!document.getElementById("delete_image" + index)) {
        const deleteInput = document.createElement("input");
        deleteInput.type = "hidden";
        deleteInput.name = "delete_image" + index;
        deleteInput.id = "delete_image" + index;
        deleteInput.value = "1";
        input.parentNode.appendChild(deleteInput);
    }
}
