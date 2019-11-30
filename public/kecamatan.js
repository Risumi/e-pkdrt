$.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
        }
    },
});

$(document).ready(function () {
    //untuk memanggil plugin select2
    $('#provinsi').select2({
        placeholder: 'Pilih Provinsi',
        language: "id"
    });
    $('#kota').select2({
        placeholder: 'Pilih Kota/Kabupaten',
        language: "id"
    });
    $('#inputKecamatan').select2({
        placeholder: 'Pilih Kecamatan',
        language: "id"
    });
    $('#inputKelurahan').select2({
        placeholder: 'Pilih Kelurahan',
        language: "id"
    });

    //saat pilihan provinsi di pilih, maka akan mengambil data kota
    //di data-wilayah.php menggunakan ajax
    // $("#provinsi").change(function () {
    //     $("img#load1").show();
    //     var id_provinces = $(this).val();
    //     $.ajax({
    //         type: "POST",
    //         dataType: "html",
    //         url: "data-wilayah.php?jenis=kota",
    //         data: "id_provinces=" + id_provinces,
    //         success: function (msg) {
    //             $("select#kota").html(msg);
    //             $("img#load1").hide();
    //             getAjaxKota();
    //         }
    //     });
    // });

    //saat pilihan kota di pilih, maka akan mengambil data kecamatan
    //di data-wilayah.php menggunakan ajax
    // $("#kota").change(getAjaxKota);

    // function getAjaxKota() {
    //     $("img#load2").show();
    //     var id_regencies = $("#kota").val();
    //     $.ajax({
    //         type: "POST",
    //         dataType: "html",
    //         url: "data-wilayah.php?jenis=kecamatan",
    //         data: "id_regencies=" + id_regencies,
    //         success: function (msg) {
    //             $("select#kecamatan").html(msg);
    //             $("img#load2").hide();
    //             getAjaxKecamatan();
    //         }
    //     });
    // }

    //saat pilihan kecamatan di pilih, maka akan mengambil data kelurahan
    //di data-wilayah.php menggunakan ajax
    getAjaxKecamatan();
    $("#inputKecamatan").change(getAjaxKecamatan);    
    function getAjaxKecamatan() {     
        var id_district = $("#inputKecamatan").val();
        var id_kasus = $("#id_kasus").val();
        // var id_kasus = {{ $kasus->id_kasus }};
        $.ajax({
            type: "POST",
            dataType: "html",
            url: new URL ("kelurahan",window.location.origin),
            data: {
                "id_district": id_district,
                "id_kasus": id_kasus,
              },            
            success: function (msg) {
                $("select#inputKelurahan").html(msg);                
                console.log(id_kasus);
            }
        });
    }

    // getAjaxKecamatanNew()
    $("#inputKecamatanNew").change(getAjaxKecamatanNew);    
    function getAjaxKecamatanNew() {     
        var id_district = $("#inputKecamatanNew").val();                
        $.ajax({
            type: "POST",
            dataType: "html",
            url: new URL ("kelurahannew",window.location.origin),
            data: {
                "id_district": id_district,                
              },            
            success: function (msg) {
                $("select#inputKelurahan").html(msg);                                
            }
        });
    }
});
