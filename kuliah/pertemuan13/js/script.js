const tombolCari = document.querySelector('.tombol-cari');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.table-ajax');

// hilangkan tombol cari
tombolCari.style.display = 'none';

// event ketika kita menuliskan keyword
keyword.addEventListener('keyup', function () {
  // ajax : bagaimana cara kita untuk melakukan request terhadap sebuah sumber, sumber bisa halaman lain bisa website
  // lain tanpa melakukan refresh pada halaman
  // xmlhttprequest
  // const xhr = new XMLHttpRequest();

  // xhr.onreadystatechange = function () {
  //   // xhr.readyState == 4 artinya sumber dari halaman ajax nya sudah siap
  //   // xhr.status == 200 artinya halaman tujuan nya ok
  //   if (xhr.readyState == 4 && xhr.status == 200) {
  //     container.innerHTML = xhr.responseText;
  //   }
  // };
  // // parameter dari open(method, request/url)
  // xhr.open('get', 'ajax/ajax_cari.php?keyword=' + keyword.value);
  // // jalankan ajax 
  // xhr.send();

  // fetch()
  fetch('ajax/ajax_cari.php?keyword=' + keyword.value)
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response));

});