//Fuction for the Slideshow Buttons
let slideIndex = 0;
showSlides();

function plusSlides(n) {
  slideIndex += n;
  showSlides();
}

function showSlides() {
  const cards = document.querySelectorAll('.card');
  const totalCards = cards.length;
  const maxVisibleCards = 5;

  // Ensure slideIndex stays within bounds
  if (slideIndex < 0) {
    slideIndex = 0;
  } else if (slideIndex > totalCards - maxVisibleCards) {
    slideIndex = totalCards - maxVisibleCards;
  }

  cards.forEach((card, index) => {
    if (index >= slideIndex && index < slideIndex + maxVisibleCards) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
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
