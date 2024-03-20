// Function for the Slideshow Buttons
let slideIndex = 0;
showSlides();

function plusSlides(n) {
  slideIndex += n;
  showSlides();
}

function showSlides() {
  const cards = document.querySelectorAll('.card');
  const screenWidth = window.innerWidth || document.documentElement.clientWidth;
  const totalCards = cards.length;

  if (screenWidth <= 720) {
    // Show only one card at a time if screen width is 720 pixels or less
    if (slideIndex < 0) {
      slideIndex = 0;
    } else if (slideIndex >= totalCards) {
      slideIndex = totalCards - 1;
    }

    cards.forEach((card, index) => {
      if (index === slideIndex) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  } else {
    // Show up to 5 cards if screen width is larger than 720 pixels
    if (slideIndex < 0) {
      slideIndex = 0;
    } else if (slideIndex > totalCards - 5) {
      slideIndex = totalCards - 5;
    }

    cards.forEach((card, index) => {
      if (index >= slideIndex && index < slideIndex + 5) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  }
}



//PHP Insert Data for the products into the Products Database
document.getElementById("insertButton").addEventListener("click", function() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "insert.php", true);
  xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              alert(xhr.responseText);
          } else {
              alert("Error: " + xhr.status);
          }
      }
  };
  xhr.send();
});
