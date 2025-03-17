// Hamburger

document.addEventListener('DOMContentLoaded', function() {
    const hamburgerIcon = document.querySelector('.hamburger-icon');
    const pageLinks = document.querySelector('.page-links');

    hamburgerIcon.addEventListener('click', function() {
        // Toggle 'active' class to show or hide the menu
        pageLinks.classList.toggle('active');
    });
});



// Read More button

document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.querySelector('.toggle-button');
    const hiddenContent = document.querySelector('.hidden-content');
    const toggleButtonHidden = document.querySelector('.toggle-button-hidden');
  
    // Ensure hidden content and "Read Less" button are hidden on page load
    hiddenContent.style.display = 'none';
    toggleButtonHidden.style.display = 'none';
  
    // Add event listener for "Read More" button
    toggleButton.addEventListener('click', function() {
      hiddenContent.style.display = 'block'; // Show the hidden content
      toggleButtonHidden.style.display = 'block'; // Show the "Read Less" button
      toggleButton.style.display = 'none'; // Hide the "Read More" button
    });
  
    // Add event listener for "Read Less" button
    toggleButtonHidden.addEventListener('click', function() {
      hiddenContent.style.display = 'none'; // Hide the hidden content
      toggleButtonHidden.style.display = 'none'; // Hide the "Read Less" button
      toggleButton.style.display = 'block'; // Show the "Read More" button
    });
  });


document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.client-btn');
    const bannerImage = document.getElementById('bannerImage');

    buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            
            // Get the new image source from the data-src attribute
            const newImageSrc = this.getAttribute('data-src');
            // Change the banner image source
            bannerImage.src = newImageSrc;
        });
    });
});

function toggleHeart(element) {
    element.classList.toggle('fas'); // Switches between 'far' (outline) and 'fas' (filled)
    element.classList.toggle('clicked'); // Add or remove the 'clicked' class for styling
}


let currentIndex = 0;

function moveCarousel(direction) {
    const images = document.querySelectorAll('.carousel-images img');
    const totalImages = images.length;

    currentIndex += direction;

    if (currentIndex < 0) {
        currentIndex = totalImages - 1; // Loop to last image
    } else if (currentIndex >= totalImages) {
        currentIndex = 0; // Loop to first image
    }

    const offset = -currentIndex * 663; // Image width
    document.querySelector('.carousel-images').style.transform = `translateX(${offset}px)`;
}



//search bar
const searchIcon = document.getElementById('search');
const searchBarContainer = document.getElementById('searchBarContainer');
const body = document.body; // Get the body element for background blur and no-scroll effect

// Show the search bar and lock the screen when the search icon is clicked
searchIcon.addEventListener('click', function() {
    searchBarContainer.classList.add('active'); // Show the search bar
    body.classList.add('blur-background', 'no-scroll'); // Add blur effect and lock screen
});

// Close the search bar and unlock the screen when the close button is clicked
document.getElementById('closeSearch').addEventListener('click', function() {
    searchBarContainer.classList.remove('active'); // Hide the search bar
    body.classList.remove('blur-background', 'no-scroll'); // Remove blur effect and unlock screen
});






//   contact
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission for demo purposes
    const button = document.getElementById('submitButton');
    button.classList.add('clicked'); // Add clicked class to change button color

    // You can add your form submission logic here
    console.log('Form submitted:', {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        message: document.getElementById('message').value,
    });
});
document.querySelectorAll('.social-icon').forEach(icon => {
    icon.addEventListener('click', function(event) {
        event.preventDefault();
        this.classList.toggle('clicked'); /* Optional effect for clicked state */
    });
});




// customer profile


// Function to toggle the dropdown menu for editing profile picture
function toggleDropdown() {
    const dropdownMenu = document.getElementById("dropdown-menu");
    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
}

function takePhoto() {
    const videoContainer = document.getElementById("video-container");
    const video = document.createElement("video");
    const constraints = { video: true };

    navigator.mediaDevices.getUserMedia(constraints)
        .then(function (stream) {
            video.srcObject = stream;
            video.play();
            videoContainer.appendChild(video);
            videoContainer.style.display = "flex"; // Show the video container
            
            const canvas = document.createElement("canvas");
            const captureButton = document.createElement("button");
            captureButton.innerText = "Capture Photo";
            videoContainer.appendChild(captureButton);

            captureButton.addEventListener("click", function () {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext("2d").drawImage(video, 0, 0);
                const imgURL = canvas.toDataURL("image/png");
                document.getElementById("profile-pic").src = imgURL;

                stream.getTracks().forEach(track => track.stop());
                videoContainer.style.display = "none"; // Hide video container
                video.remove();
                canvas.remove();
                captureButton.remove();
            });
        })
        .catch(function (error) {
            console.error("Error accessing camera: ", error);
            alert("Unable to access the camera.");
        });
}


// Choose photo function (Opens file explorer and updates the profile picture)
function choosePhoto() {
    const fileInput = document.createElement("input");
    fileInput.type = "file";
    fileInput.accept = "image/*";
    fileInput.onchange = function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("profile-pic").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
    fileInput.click();
}

// Delete photo function (resets to a default image)
function deletePhoto() {
    document.getElementById("profile-pic").src = "images/default.jpg"; // Set to a default image
}

// Function to show real-time date
function showDate() {
    const dateElement = document.getElementById("date");
    const today = new Date();
    dateElement.innerText = today.toLocaleDateString(); // Update to show current date
}

// Add email function (Adds an email address to the email section)
function addEmail() {
    const emailInput = document.getElementById("email");
    const emailAddress = emailInput.value;

    if (emailAddress) {
        const emailInfoDiv = document.getElementById("email-info");
        const newEmail = document.createElement("p");
        newEmail.innerText = emailAddress;
        emailInfoDiv.appendChild(newEmail);
        emailInput.value = ''; // Clear input after adding
    } else {
        alert("Please enter an email address.");
    }
}

// Show notifications (Placeholder function for notifications)
function showNotification() {
    alert("You have new notifications!");
}

// Call showDate to set the date on page load
window.onload = showDate;

// Function to open the email dialog
function openEmailDialog() {
    document.getElementById("emailDialog").style.display = "flex";
}

// Function to close the email dialog
function closeEmailDialog() {
    document.getElementById("emailDialog").style.display = "none";
}

// Function to save the new email
function saveEmail() {
    const newEmail = document.getElementById("newEmail").value;
    if (newEmail) {
        const emailInfo = document.getElementById("email-info");
        const emailElement = document.createElement("p");
        emailElement.textContent = newEmail;
        emailInfo.appendChild(emailElement);
        document.getElementById("newEmail").value = ""; // Clear input
        closeEmailDialog(); // Close dialog
    } else {
        alert("Please enter an email address.");
    }
}
// Get the modal
var dialog = document.getElementById("emailDialog");

// Get the button that opens the dialog
var addEmailBtn = document.getElementById("addEmailBtn");

// Get the <span> element that closes the dialog
var closeBtn = document.getElementById("closeBtn");

// Get the list to display email addresses
var emailList = document.getElementById("emailList");

// Load emails and selected email from localStorage if available
var emails = JSON.parse(localStorage.getItem("emails")) || [];
var selectedEmail = localStorage.getItem("selectedEmail") || "";

// Display stored emails on page load
window.onload = function() {
    updateEmailList();
}

// When the user clicks on the button, open the dialog
addEmailBtn.onclick = function() {
    dialog.style.display = "block";
}

// When the user clicks on <span> (x), close the dialog
closeBtn.onclick = function() {
    dialog.style.display = "none";
}

// When the user clicks anywhere outside of the dialog, close it
window.onclick = function(event) {
    if (event.target == dialog) {
        dialog.style.display = "none";
    }
}

// Function to save the email address and add it to the list
var saveEmailBtn = document.getElementById("saveEmailBtn");
saveEmailBtn.onclick = function() {
    var newEmail = document.getElementById("newEmail").value;
    
    if (newEmail && validateEmail(newEmail)) {
        emails.push(newEmail); // Save email to array
        localStorage.setItem("emails", JSON.stringify(emails)); // Save emails to localStorage
        updateEmailList();     // Update email list display
        document.getElementById("newEmail").value = ""; // Clear input field
        dialog.style.display = "none"; // Close the dialog
    } else {
        alert("Please enter a valid email address.");
    }
}

// Validate email function
function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Function to update the email list
function updateEmailList() {
    emailList.innerHTML = ""; // Clear the list first
    emails.forEach((email, index) => {
        var li = document.createElement("li");

        // Create a radio button to select the email
        var radio = document.createElement("input");
        radio.type = "radio";
        radio.name = "emailSelect";
        radio.value = email;
        radio.id = `email-${index}`;
        radio.checked = email === selectedEmail; // Check if it's the selected email
        li.appendChild(radio);

        // Add an event listener to save the selected email when the radio button is clicked
        radio.addEventListener("click", function() {
            selectedEmail = email;
            localStorage.setItem("selectedEmail", selectedEmail); // Save selected email to localStorage
        });

        // Create a label for the email
        var label = document.createElement("label");
        label.setAttribute("for", `email-${index}`);
        label.textContent = email;
        li.appendChild(label);

        emailList.appendChild(li);
    });
}






// Custom Design page

// image categories 
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.client-btn');
    const bannerImage = document.getElementById('bannerImage');

    buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            
            // Get the new image source from the data-src attribute
            const newImageSrc = this.getAttribute('data-src');
            // Change the banner image source
            bannerImage.src = newImageSrc;
        });
    });
});


function changeImage(imageSrc) {
    const designImage = document.getElementById('designImage');
    designImage.src = imageSrc;
  }


  // checkout page 

  // Function to validate the address form
function validateAddressForm() {
    const addressForm = document.getElementById('address-form');
    const firstName = document.getElementById('first-name');
    const lastName = document.getElementById('last-name');
    const streetAddress = document.getElementById('street-address');
    const city = document.getElementById('city');
    const state = document.getElementById('state');
    const zip = document.getElementById('zip');

    let isValid = true;

    if (!firstName.value) {
        isValid = false;
        firstName.classList.add('is-invalid');
    } else {
        firstName.classList.remove('is-invalid');
    }

    if (!lastName.value) {
        isValid = false;
        lastName.classList.add('is-invalid');
    } else {
        lastName.classList.remove('is-invalid');
    }

    if (!streetAddress.value) {
        isValid = false;
        streetAddress.classList.add('is-invalid');
    } else {
        streetAddress.classList.remove('is-invalid');
    }

    if (!city.value) {
        isValid = false;
        city.classList.add('is-invalid');
    } else {
        city.classList.remove('is-invalid');
    }

    if (!state.value) {
        isValid = false;
        state.classList.add('is-invalid');
    } else {
        state.classList.remove('is-invalid');
    }

    if (!zip.value || isNaN(zip.value) || zip.value.length < 5) {
        isValid = false;
        zip.classList.add('is-invalid');
    } else {
        zip.classList.remove('is-invalid');
    }

    return isValid;
}

// Function to validate the card form
function validateCardForm() {
    const cardForm = document.getElementById('card-form');
    const cardName = document.getElementById('card-name');
    const cardNumber = document.getElementById('card-number');
    const expDate = document.getElementById('exp-date');
    const cvv = document.getElementById('cvv');

    let isValid = true;

    if (!cardName.value) {
        isValid = false;
        cardName.classList.add('is-invalid');
    } else {
        cardName.classList.remove('is-invalid');
    }

    if (!cardNumber.value || isNaN(cardNumber.value) || cardNumber.value.length !== 16) {
        isValid = false;
        cardNumber.classList.add('is-invalid');
    } else {
        cardNumber.classList.remove('is-invalid');
    }

    if (!expDate.value || !/^(0[1-9]|1[0-2])\/\d{2}$/.test(expDate.value)) {
        isValid = false;
        expDate.classList.add('is-invalid');
    } else {
        expDate.classList.remove('is-invalid');
    }

    if (!cvv.value || isNaN(cvv.value) || cvv.value.length !== 3) {
        isValid = false;
        cvv.classList.add('is-invalid');
    } else {
        cvv.classList.remove('is-invalid');
    }

    return isValid;
}

// Event Listeners for Buttons
document.querySelector('.save-address').addEventListener('click', function () {
    if (validateAddressForm()) {
        alert('Address saved successfully!');
        // Clear the form after saving
        document.getElementById('address-form').reset();
        document.querySelectorAll('.form-control').forEach(input => input.classList.remove('is-invalid'));
    }
});

document.querySelector('.save-card').addEventListener('click', function () {
    if (validateCardForm()) {
        alert('Card saved successfully!');
        // Clear the form after saving
        document.getElementById('card-form').reset();
        document.querySelectorAll('.form-control').forEach(input => input.classList.remove('is-invalid'));
    }
});

// Clear button functionality
document.querySelector('.clear-address').addEventListener('click', function () {
    document.getElementById('address-form').reset();
    document.querySelectorAll('.form-control').forEach(input => input.classList.remove('is-invalid'));
});

// Place Order button functionality
document.querySelector('.place-order').addEventListener('click', function () {
    if (validateAddressForm() && validateCardForm()) {
        alert('Your order has been placed successfully!');
        // Additional actions after placing the order can be added here
    } else {
        alert('Please fill out all required fields correctly.');
    }
});

// Select all the step circles
const circles = document.querySelectorAll('.circle');

// Function to toggle the 'active' state between steps
function toggleStep(stepNumber) {
    circles.forEach((circle, index) => {
        if (index < stepNumber) {
            circle.classList.add('active');
        } else {
            circle.classList.remove('active');
        }
    });
}


// Example usage: Trigger to activate step 2
// Call toggleStep(2); to activate the second step
// Uncomment the line below to activate step 2 automatically
// toggleStep(2);


 
//reset password

document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function () {
        this.style.color = 'black';
    });
});

//login
//email verification
document.getElementById("emailForm").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const email = document.getElementById("email").value;
  
    if (email) {
      alert(`A reset password link has been sent to ${email}`);
      // Additional logic to handle sending the email can go here
    } else {
      alert("Please enter a valid email address.");
    }
  });


//reset
  document.getElementById("resetForm").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
  
    if (password === confirmPassword) {
      alert("Password reset successful!");
      this.reset(); // Clears the form fields
    } else {
      alert("Passwords do not match. Please try again.");
    }
  });

  

// collection new
document.addEventListener('DOMContentLoaded', () => {
    console.log('Page Loaded');
  });
  
  
  