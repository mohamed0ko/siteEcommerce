function previewImage(input, previewId, removeBtnId) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById(previewId).src = e.target.result;
            document.getElementById(removeBtnId).style.display = "inline-block";
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage(index) {
    document.getElementById("image" + index).value = "";
    document.getElementById("preview" + index).src =
        "https://via.placeholder.com/120";
    document.getElementById("removeBtn" + index).style.display = "none";
}
