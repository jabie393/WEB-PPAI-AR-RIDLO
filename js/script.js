    //js preload
    window.onload = function () {
      const preloader = document.getElementById('preloader');
      preloader.style.opacity = '0'; // Tambahkan animasi transisi
      preloader.style.transition = 'opacity 0.5s ease';
  
      // Tunggu hingga transisi selesai, lalu hapus preloader dari DOM
      setTimeout(() => {
      preloader.style.display = 'none';
    }, 500); // Sesuai dengan durasi transisi
  };

document.addEventListener("DOMContentLoaded", () => {
    const preloader = document.getElementById('preloader');
    const progressText = document.querySelector('.progress-text');
    const spinner = document.querySelector('.spinner');
    
    let progress = 0;

    // Simulasikan pemuatan menggunakan interval
    const interval = setInterval(() => {
        if (progress < 100) {
            progress += 1;
            progressText.textContent = `${progress}%`;
        } else {
            clearInterval(interval);
            preloader.style.opacity = '0';
            preloader.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                preloader.style.display = 'none';
                startAnimations(); // Pastikan fungsi ini dipanggil jika digunakan
            }, 500);
        }
    }, 30); // Percepat interval sesuai kebutuhan
});

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
        const header = section.querySelector('h2') || section.firstElementChild; // Contoh target adalah <h2> dalam section
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
