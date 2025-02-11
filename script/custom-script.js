document.addEventListener("DOMContentLoaded", function () {
  function previewForm() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let category = document.getElementById("category").value;
    let message = document.getElementById("message").value;

    // Client-side validation
    if (!name || /\d/.test(name)) {
      alert("Name is required and should not contain numbers.");
      return;
    }
    if (!email) {
      alert("Email is required.");
      return;
    }
    if (!category) {
      alert("Please select a category.");
      return;
    }
    if (!message || message.length > 250) {
      alert("Message is required and must be within 250 characters.");
      return;
    }

    // Show preview
    document.getElementById("previewName").innerText = name;
    document.getElementById("previewEmail").innerText = email;
    document.getElementById("previewCategory").innerText = category;
    document.getElementById("previewMessage").innerText = message;
    document.getElementById("formPreview").style.display = "block";
  }

  // Attach event listener to button
  document
    .getElementById("previewButton")
    .addEventListener("click", previewForm);
});
