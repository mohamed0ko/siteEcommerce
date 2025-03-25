function previewImage(input, previewId, removeBtnId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById(previewId).src = e.target.result;
            document.getElementById(previewId).style.display = "block";
            document.getElementById(removeBtnId).style.display = "flex";
        };
        reader.readAsDataURL(file);
    }
}

function removeImage(index) {
    document.getElementById("preview" + index).src =
        "https://via.placeholder.com/120";
    document.getElementById("preview" + index).style.display = "none";
    document.getElementById("removeBtn" + index).style.display = "none";
    document.getElementById("imageUpload" + index).value = "";
    document.getElementById("title" + index).value = "";
}
