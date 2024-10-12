/* A fucntion to preview uploaded image*/
function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        imagePreview.src = "#";
        imagePreview.style.display = 'none';
    }
}


function previewProfile(event) {
  const avatarPreview = document.getElementById("avatarHolder");
  const file = event.target.files[0];
  const reader = new FileReader();

  reader.onload = function (e) {
      // Set the background image with the correct `url()` format
    avatarPreview.style.backgroundImage = `url('${e.target.result}')`;
  };

  // Read the file as a Data URL (base64 encoded string)
  reader.readAsDataURL(file);
}