const flashdata = $('.flash-data').data('flashdata');

if (flashdata){
    Swal.fire({
        tittle: 'Hasil Jawaban',
        text: 'berhasil' + flashdata,
        icon: 'success'
    });
}