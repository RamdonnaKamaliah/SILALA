// favorit.js
document.addEventListener('DOMContentLoaded', function() {
  // Setup semua fungsi
  setupFavoritesSearch();
  setupFavoriteButtons();
  
  function setupFavoritesSearch() {
    const searchInput = document.getElementById('searchBuku');
    const bookCards = document.querySelectorAll('.book-card');
    const noSearchResults = document.getElementById('no-favorites-search');
    const favoritesGrid = document.getElementById('favorites-grid');
    const noFavoritesDefault = document.getElementById('no-favorites-default');
    
    if (!searchInput || bookCards.length === 0) return;
    
    function performSearch() {
      const keyword = searchInput.value.toLowerCase().trim();
      let visibleCount = 0;
      
      // Reset tampilan
      if (noSearchResults) noSearchResults.classList.add('hidden');
      if (favoritesGrid) favoritesGrid.style.display = 'grid';
      if (noFavoritesDefault) noFavoritesDefault.style.display = 'block';
      
      // Filter cards berdasarkan keyword
      bookCards.forEach(card => {
        const judul = card.getAttribute('data-judul') || '';
        const penulis = card.getAttribute('data-penulis') || '';
        const isMatch = judul.includes(keyword) || penulis.includes(keyword);
        
        if (isMatch) {
          card.style.display = 'flex';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });
      
      // Tampilkan pesan jika tidak ada hasil pencarian
      if (keyword !== '' && visibleCount === 0) {
        if (noSearchResults) {
          noSearchResults.classList.remove('hidden');
        }
        if (favoritesGrid) {
          favoritesGrid.style.display = 'none';
        }
        if (noFavoritesDefault) {
          noFavoritesDefault.style.display = 'none';
        }
      }
    }
    
    searchInput.addEventListener('input', performSearch);
    searchInput.addEventListener('search', function() {
      if (this.value === '') performSearch();
    });
  }
  
  function setupFavoriteButtons() {
    // Setup event listener untuk semua tombol favorit
    document.addEventListener('click', function(e) {
      const favoriteBtn = e.target.closest('.favorite-btn');
      if (favoriteBtn) {
        e.preventDefault();
        const bookId = favoriteBtn.getAttribute('data-book-id');
        hapusFavorite(favoriteBtn, bookId);
      }
    });
  }
  
  // Fungsi untuk menghapus favorit
  async function hapusFavorite(button, bookId) {
    try {
      // Tampilkan konfirmasi
      if (!confirm('Yakin ingin menghapus buku ini dari favorit?')) {
        return;
      }
      
      // Ambil CSRF token dari meta tag
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                       document.querySelector('input[name="_token"]')?.value;
      
      if (!csrfToken) {
        console.error('CSRF token not found');
        alert('Terjadi kesalahan. Silakan refresh halaman.');
        return;
      }
      
      // Kirim request DELETE (bukan POST karena menghapus)
      const response = await fetch(favoritRoute, {
        method: "POST", // Karena Laravel menggunakan POST untuk toggle
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken,
          "Accept": "application/json"
        },
        body: JSON.stringify({ 
          buku_id: bookId,
          _method: "POST" // Untuk simulasi metode yang sesuai
        })
      });
      
      const result = await response.json();
      
      if (response.ok) {
        // Hapus card buku dari DOM
        const bookCard = button.closest('.book-card');
        if (bookCard) {
          bookCard.remove();
          
          // Cek apakah masih ada buku favorit
          const remainingBooks = document.querySelectorAll('.book-card');
          const favoritesGrid = document.getElementById('favorites-grid');
          const noFavoritesDefault = document.getElementById('no-favorites-default');
          
          // Jika tidak ada buku favorit lagi
          if (remainingBooks.length === 0) {
            if (favoritesGrid) {
              favoritesGrid.style.display = 'none';
            }
            if (noFavoritesDefault) {
              noFavoritesDefault.classList.remove('hidden');
              noFavoritesDefault.style.display = 'block';
            }
          }
          
          // Tampilkan pesan sukses
          showNotification('Buku berhasil dihapus dari favorit', 'success');
        }
      } else {
        throw new Error('Failed to remove favorite');
      }
    } catch (error) {
      console.error('Error:', error);
      showNotification('Gagal menghapus favorit. Silakan coba lagi.', 'error');
    }
  }
  
  // Fungsi untuk menampilkan notifikasi
  function showNotification(message, type = 'success') {
    // Hapus notifikasi lama jika ada
    const oldNotification = document.querySelector('.custom-notification');
    if (oldNotification) {
      oldNotification.remove();
    }
    
    // Buat notifikasi baru
    const notification = document.createElement('div');
    notification.className = `custom-notification fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ${
      type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    notification.style.opacity = '0';
    notification.style.transform = 'translateY(-20px)';
    
    document.body.appendChild(notification);
    
    // Animasikan masuk
    setTimeout(() => {
      notification.style.opacity = '1';
      notification.style.transform = 'translateY(0)';
    }, 10);
    
    // Hapus otomatis setelah 3 detik
    setTimeout(() => {
      notification.style.opacity = '0';
      notification.style.transform = 'translateY(-20px)';
      setTimeout(() => {
        if (notification.parentNode) {
          notification.remove();
        }
      }, 300);
    }, 3000);
  }
  
  // Ekspos fungsi ke global scope
  window.hapusFavorite = hapusFavorite;
});