// Tambahkan event listener pada semua link di navbar
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', event => {
    const targetLink = event.target;

    // Cegah default behavior
    event.preventDefault();

    // Hapus kelas .active dari semua tautan
    document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));

    // Tambahkan kelas .active ke tautan yang diklik
    targetLink.classList.add('active');

    // Dapatkan href dari tautan
    const href = targetLink.getAttribute('href');

    // Jika href mengarah ke halaman index atau memiliki ID section
    if (href && href.includes('index.html#')) {
      // Navigasi ke halaman index dengan fragment
      window.location.href = href;
      return;
    }

    // Jika mengarah ke ID section di halaman yang sama
    if (href && href.startsWith('#')) {
      const sectionId = href.replace('#', '');
      const section = document.getElementById(sectionId);

      // Scroll langsung ke elemen section
      if (section) {
        const header = section.querySelector('h2'); // Contoh target adalah <h2> dalam section
        const navbarHeight = document.querySelector('.navbar').offsetHeight; // Tinggi navbar
        const additionalOffset = 25; // Jarak tambahan di atas elemen
        const offset = (header || section).getBoundingClientRect().top + window.scrollY - navbarHeight - additionalOffset;

        // Lakukan smooth scrolling
        window.scrollTo({
          top: offset,
          behavior: 'smooth',
        });
      }
    }
  });
});

// Seleksi elemen offcanvas dan semua tautan dalam offcanvas
const offcanvasElement = document.getElementById('offcanvasNavbar');
const offcanvasLinks = document.querySelectorAll('#offcanvasNavbar .nav-link');

offcanvasLinks.forEach(link => {
  link.addEventListener('click', event => {
    const targetLink = event.target;

    // Jika tautan adalah "Informasi"
    if (targetLink.textContent.trim() === 'Informasi') {
      // Ubah warna teks menjadi hijau
      return; // Jangan tutup offcanvas untuk "Informasi"
    }

    // Tutup offcanvas untuk tautan lainnya
    const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
    if (offcanvas) {
      offcanvas.hide();
    }
  });
});
