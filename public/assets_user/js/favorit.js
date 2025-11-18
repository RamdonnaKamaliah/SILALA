document.getElementById('searchBuku').addEventListener('keyup', function() {
  let keyword = this.value.toLowerCase();
  let cards = document.querySelectorAll('.book-card');

  cards.forEach(card => {
    let title = card.querySelector('.book-title').textContent.toLowerCase();
    
    if(title.includes(keyword)) {
      card.style.display = "flex"; 
    } else {
      card.style.display = "none";
    }
  });
});