// Tambahkan event listener pada semua link di navbar
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', event => {
    // Cegah default behavior dari tautan
    event.preventDefault();

    // Hapus kelas .active dari semua tautan
    document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));

    // Tambahkan kelas .active ke tautan yang diklik
    event.target.classList.add('active');

    // Dapatkan id section yang ingin dituju
    const sectionId = event.target.getAttribute('href').replace('#', '');
    const section = document.getElementById(sectionId);

    // Scroll langsung ke elemen <h2> dalam section
    if (section) {
      const header = section.querySelector('h2');
      if (header) {
        const navbarHeight = document.querySelector('.navbar').offsetHeight; // Tinggi navbar
        const additionalOffset = 25; // Jarak tambahan di atas elemen
        const offset = header.getBoundingClientRect().top + window.scrollY - navbarHeight - additionalOffset;

        // Lakukan smooth scrolling ke posisi <h2> dengan jarak tambahan
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

    // Periksa jika elemen yang diklik adalah Navbar Informasi
    if (targetLink.textContent.trim() === 'Informasi') {
      // Jangan tutup offcanvas jika elemen adalah Navbar Informasi
      return;
    }

    // Tutup offcanvas untuk tautan lainnya
    const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
    if (offcanvas) {
      offcanvas.hide();
    }
  });
});
