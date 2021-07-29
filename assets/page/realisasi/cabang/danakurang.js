window.onscroll = function () {
    myFunction()
};

const header = document.getElementById("myHeader");
const sticky = header.offsetTop;
const sticky_container = document.getElementById("check-all-container");
const tab_main = document.getElementById("tab-main");

function myFunction() {
    if (window.pageYOffset > sticky + 30) {
        header.classList.add("sticky");
        header.classList.add("shadow-sm");
        sticky_container.classList.add("bg-secondary");
        sticky_container.classList.add("text-light");
        tab_main.classList.add("mb-5");
    } else {
        header.classList.remove("sticky");
        header.classList.remove("shadow-sm");
        sticky_container.classList.remove("bg-secondary");
        sticky_container.classList.remove("text-light");
        tab_main.classList.remove("mb-5");
    }
}
let id_realisasi_send = [];
let id_rab_send = [];
let ringgit_send = [];
let rupiah_send = [];
let jumlah_ringgit_send = 0;
let jumlah_rupiah_send = 0;

function handleSetAllCheckbox(data) {
    $(".check").prop("checked", data.checked);
    setBtnUbah();
}
const cekvalidasi = (id, val = "", focus = false) => {
    const valid = $(`#${id}`);
    let isValid = true;

    if (valid.val() == val) {
        isValid = false;
        valid.removeClass("is-valid").addClass("is-invalid");
        if (focus) valid.focus();
    } else {
        valid.removeClass("is-invalid").addClass("is-valid");
    }
    return isValid;
}

$(document).ready(function () {
    function dynamic() {
        Loader();
        $.ajax({
            method: 'post',
            url: base_url + 'realisasi/danaKurang/ajax_data',
            data: {
                npsn: npsn,
                id_cabang: id_cabang
            }
        }).done((data) => {
            const body = $("#list-body");
            body.empty();
            data.data.forEach(element => {
                body.append(`
                <label class="list-group-item d-flex" for="listCheckbox${element.id}">
                <input class="form-check-input me-2 check" id="listCheckbox${element.id}" type="checkbox" value="" style="width: 25px; height: 25px; margin-right: 10px;"
                    data-id_rab="${element.id}"
                    data-id_realisasi="${element.id_realisasi}"
                    data-ringgit="${element.sisa_ringgit}"
                    data-uraian="${element.nama_aktifitas}"
                    data-kode="${element.kodes}"
                    data-rupiah="${element.sisa_rupiah}">
                <div class="chat-user-info">
                    <h6 class="text-truncate mb-0" style="font-size: 1em;">${element.kode} | (RM ${format_ringgit(element.sisa_ringgit)})</h6>
                    <div class="last-chat">
                        <p class="text-truncate mb-0" style="font-size: 1em;"> ${element.nama_aktifitas}</p>
                    </div>
                </div>
            </label>
                `);
            });

            $(".check").on('change', function () {
                setBtnUbah();
            });
        })
            .fail(($xhr) => {
                setToast('danger', 'danger', 'Failed', 'Gagal mendapatkan data');
            }).
            always(() => {
                Loader(false);
            })
    }
    dynamic();


    $("#form").submit(function (ev) {
        ev.preventDefault();
        // displaySwitch();
        id_rab_send = [];
        ringgit_send = [];
        rupiah_send = [];
        let jml_ringgit = 0;
        let jml_rupiah = 0;

        let html_uraian = ``;

        let dataOk = false;

        $(".check").each(function () {
            if (this.checked) {
                dataOk = true;
                id_rab_send.push(this.dataset.id_rab);
                ringgit_send.push(this.dataset.ringgit);
                rupiah_send.push(this.dataset.rupiah);
                id_realisasi_send.push(this.dataset.id_realisasi);

                jml_ringgit += Number(this.dataset.ringgit);
                jml_rupiah += Number(this.dataset.rupiah);

                jumlah_ringgit_send = jml_ringgit;
                jumlah_rupiah_send = jml_rupiah;

                html_uraian += `
                    <label class="list-group-item d-flex">
                    <div class="chat-user-info">
                    <h6 class="text-truncate mb-0" style="font-size: 1em;">${this.dataset.kode} | (RM ${format_ringgit(this.dataset.ringgit)})</h6>
                    <div class="last-chat">
                    <p class="text-truncate mb-0" style="font-size: 1em;"> ${this.dataset.uraian}</p>
                    </div>
                    </div>
                    </label>
                `;
            }
        });
        if (dataOk) {
            // rab
            $("#sisa-ringgit").val(jml_ringgit)
            $("#sisa-rupiah").val(jml_rupiah)
            $("#jumlah-sisa-ringgit").val('RM ' + format_ringgit(jml_ringgit))
            $("#jumlah-sisa-rupiah").val('Rp ' + format_rupiah(jml_rupiah))

            // non-rab
            $("#val_harga_ringgit").val(jml_ringgit)
            $("#val_harga_rupiah").val(jml_rupiah)
            $("#harga_ringgit").val('RM ' + format_ringgit(jml_ringgit))
            $("#harga_rupiah").val('Rp ' + format_rupiah(jml_rupiah))

            $("#val_total_harga_ringgit").val(jml_ringgit)
            $("#val_total_harga_rupiah").val(jml_rupiah)
            $("#total_harga_ringgit").val('RM ' + format_ringgit(jml_ringgit))
            $("#total_harga_rupiah").val('Rp ' + format_rupiah(jml_rupiah))

            // toggle dan uraian
            $("#modal-uraian").html(html_uraian);
            $("#fullscreenModal").modal("toggle");
        } else {
            setToast('danger', 'danger', 'Failed', 'Belum ada data yang dipilih');
        }
    })

    $('#belanja-text-harga-ringgit').on('change', function () {
        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getkurs',
            data: {
                ringgit: this.value,
            },
        }).done((data) => {
            $("#belanja-harga-ringgit").val(this.value)
            $("#belanja-text-harga-ringgit").val('RM ' + format_ringgit(this.value, false))
            $("#belanja-harga-rupiah").val(data.rupiah)
            $("#belanja-text-harga-rupiah").val('Rp ' + format_rupiah(data.rupiah, false))
        }).fail(($xhr) => {
            console.log($xhr)
        })

    })

    $('#form-belanja').submit(function (evt) {
        evt.preventDefault();

        let validasi = cekvalidasi("val-kode", "", true) && cekvalidasi("keterangan", "", true);

        if (validasi) {
            $.ajax({
                type: 'POST',
                url: base_url + 'realisasi/danaKurang/insertkurang',
                data: {
                    data: JSON.stringify({
                        'id_realisasi': id_realisasi_send,
                        'id_rab': id_rab_send,
                        'sisa_ringgit': ringgit_send,
                        'sisa_rupiah': rupiah_send,
                        'ringgit': jumlah_ringgit_send,
                        'rupiah': jumlah_rupiah_send,
                        'keterangan': $('#keterangan').val(),
                        'kategori': $("#pilihan-tambahan").val(),
                        'id_cabang': $("#id_cabang").val(),
                        'id_rab_to': $('#id_rab').val()
                    }),
                    non_rab: {

                    }
                },
                success: function (data) {
                    if (data.result) {
                        setToast('success', 'primary', 'Success', 'Data Berhasil Diubah');
                    } else {
                        setToast('danger', 'danger', 'Failed', 'Data gagal diubah');
                    }
                    $('#fullscreenModal').modal('toggle');
                    dynamic();
                },
                error: function (data) {
                    $('#fullscreenModal').modal('toggle');
                    setToast('danger', 'danger', 'Failed', 'Data gagal diubah');
                    dynamic();
                }
            });
        }
    });

    $("#pilihan-tambahan").change(function () {
        // displaySwitch();
    });

    // rab kode standar
    $('#val-kode').on('change', function () {
        $.ajax({
            type: 'POST',
            url: base_url + 'realisasi/danaSisa/cek_kode',
            data: {
                kode: this.value,
                id_cabang: id_cabang
            },
            success: function (data) {
                if (data) {
                    jumlah_ringgit_send = data.total_harga_ringgit;
                    jumlah_rupiah_send = data.total_harga_rupiah;
                    $('#id_rab').val(data.id)
                    $('#total-ringgit').val(data.total_harga_ringgit);
                    $('#jumlah-total-ringgit').val('RM ' + format_ringgit(data.total_harga_ringgit));
                    $('#total-rupiah').val(data.total_harga_rupiah);
                    $('#jumlah-total-rupiah').val('Rp ' + format_rupiah(data.total_harga_rupiah));
                    // jumlahkan
                    $('#sisa-total-ringgit').val(Number(data.total_harga_ringgit) + Number($("#sisa-ringgit").val()));
                    $('#jumlah-sisa-total-ringgit').val('RM ' + format_ringgit(Number(data.total_harga_ringgit) + Number($("#sisa-ringgit").val())));
                    $('#sisa-total-rupiah').val(Number(data.total_harga_rupiah) + Number($("#sisa-rupiah").val()));
                    $('#jumlah-sisa-total-rupiah').val('Rp ' + format_rupiah(Number(data.total_harga_rupiah) + Number($("#sisa-rupiah").val())));

                } else {
                    jumlah_ringgit_send = 0;
                    jumlah_rupiah_send = 0;
                    $('#id_rab').val("");
                    $('#total-ringgit').val("");
                    $('#jumlah-total-ringgit').val("");
                    $('#total-rupiah').val("");
                    $('#jumlah-total-rupiah').val("");

                    $('#sisa-total-ringgit').val("");
                    $('#jumlah-sisa-total-ringgit').val("");
                    $('#sisa-total-rupiah').val("");
                    $('#jumlah-sisa-total-rupiah').val("");
                }

                cekvalidasi("val-kode");
            }
        })
    })


    // non-rab
    $.ajax({
        method: 'post',
        url: base_url + 'rab/clc/getAktifitas',
        data: null,
    }).done((data) => {
        $('#id_aktifitas').html('<option value="">--Pilih Aktifitas--</option>')

        $.each(data, (value, key) => {
            $('#id_aktifitas').append("<option value='" + key.id + "'>" + key.kode + " - " + key.uraian + "</option>")
        })

    }).fail(($xhr) => {
        console.log($xhr)
    })

    $('#id_aktifitas').on('change', () => {
        let id_aktifitas = $('#id_aktifitas').val()

        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getAktifitasSub',
            data: {
                id_aktifitas: id_aktifitas
            },
        }).done((data) => {
            $('#id_aktifitas_sub').html('<option value="">--Pilih Sub Aktifitas--</option>')

            $.each(data, (value, key) => {
                $('#id_aktifitas_sub').append("<option value='" + key.id + "'>" + key.kode + " - " + key.uraian + "</option>")
                $('#id_aktifitas_cabang').empty();
                $('#kode_isi_1').empty();
                $('#kode_isi_2').empty();
            })

        }).fail(($xhr) => {
            console.log($xhr)
        })
    })

    $('#id_aktifitas_sub').on('change', () => {
        let id_aktifitas_sub = $('#id_aktifitas_sub').val()
        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getAktifitasCabang',
            data: {
                id_aktifitas_sub: id_aktifitas_sub
            },
        }).done((data) => {
            $('#id_aktifitas_cabang').html('<option value="">--Pilih Sub Aktifitas--</option>')

            $.each(data, (value, key) => {
                $('#id_aktifitas_cabang').append("<option value='" + key.id + "'>" + key.kode + " - " + key.nama + "</option>")
            })
            $('#kode_isi_1').empty();
            $('#kode_isi_2').empty();
        }).fail(($xhr) => {
            console.log($xhr)
        })

        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getKodeCabang',
            data: {
                id_aktifitas_sub: id_aktifitas_sub
            },
        }).done((data) => {
            let detail = data.kode.split('.')
            var tamp = Number(detail[2]) + 1
            let kode = detail[0] + '.' + detail[1] + '.' + tamp
            $("#kode").val(kode)
        }).fail(($xhr) => {
            console.log($xhr)
        })
    })

    $('#id_aktifitas_cabang').on('change', () => {
        let id_aktifitas_cabang = $('#id_aktifitas_cabang').val()

        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getAktifitasCabangKodeIsi1',
            data: {
                id_aktifitas_cabang: id_aktifitas_cabang
            },
        }).done((data) => {
            $('#kode_isi_1').html('<option value="">--Pilih Sub Aktifitas--</option>')

            $.each(data, (value, key) => {
                $('#kode_isi_1').append("<option value='" + key.id + "'>" + key.kode + " - " + key.nama + "</option>")
            })

            $.ajax({
                method: 'post',
                url: base_url + 'rab/clc/getKodeCabangKodeIsi1',
                data: {
                    id_aktifitas_cabang: id_aktifitas_cabang
                },
            }).done((data) => {
                let detail = data.kode.split('.')
                var tamp = Number(detail[3]) + 1
                let kode = detail[0] + '.' + detail[1] + '.' + detail[2] + '.' + tamp
            }).fail(($xhr) => {
                console.log($xhr)
            })
            $("#kode").val(kode)
            $('#kode_isi_2').empty();
        }).fail(($xhr) => {
            console.log($xhr)
        })
    })

    $('#kode_isi_1').on('change', () => {
        let kode_isi_1 = $('#kode_isi_1').val()

        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getAktifitasCabangKodeIsi2',
            data: {
                kode_isi_1: kode_isi_1
            },
        }).done((data) => {
            $('#kode_isi_2').html('<option value="">--Pilih Sub Aktifitas--</option>')

            $.each(data, (value, key) => {
                $('#kode_isi_2').append("<option value='" + key.id + "'>" + key.kode + " - " + key.nama + "</option>")
            })

            $.ajax({
                method: 'post',
                url: base_url + 'rab/clc/getKodeCabangKodeIsi2',
                data: {
                    kode_isi_1: kode_isi_1
                },
            }).done((data) => {
                let detail = data.kode.split('.')
                var tamp = Number(detail[4]) + 1
                let kode = detail[0] + '.' + detail[1] + '.' + detail[2] + '.' + detail[3] + '.' + tamp
                $("#kode").val(kode)
            }).fail(($xhr) => {
                console.log($xhr)
            })

        }).fail(($xhr) => {
            console.log($xhr)
        })
    })

    $('#kode_isi_2').on('change', () => {
        let kode_isi_2 = $('#kode_isi_2').val()

        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getAktifitasCabangKodeIsi3',
            data: {
                kode_isi_2: kode_isi_2
            },
        }).done((data) => {
            $('#kode_isi_3').html('<option value="">--Pilih Sub Aktifitas--</option>')

            $.each(data, (value, key) => {
                $('#kode_isi_3').append("<option value='" + key.id + "'>" + key.kode + " - " + key.nama + "</option>")
            })

            $.ajax({
                method: 'post',
                url: base_url + 'rab/clc/getKodeCabangKodeIsi3',
                data: {
                    kode_isi_2: kode_isi_2
                },
            }).done((data) => {
                console.log(data);
                let detail = data.kode.split('.')
                var tamp = Number(detail[5]) + 1
                let kode = detail[0] + '.' + detail[1] + '.' + detail[2] + '.' + detail[3] + '.' + detail[4] + '.' + tamp
                $("#kode").val(kode)
            }).fail(($xhr) => {
                console.log($xhr)
            })
        }).fail(($xhr) => {
            console.log($xhr)
        })
    })

    $('#kode_isi_3').on('change', () => {

    })
})

function setBtnUbah() {

    let submitOk = false;
    let checkAll = true;
    $(".check").each(function () {
        if (this.checked) submitOk = true;
        if (!this.checked) checkAll = false;

    });
    if (submitOk) {
        $("#btn-ubah").removeAttr("disabled");
    } else {
        $("#btn-ubah").attr("disabled", "");
    }
    $("#check-all").prop('checked', checkAll);
}

function format_ringgit(angka, format = 2, prefix) {
    angka = angka.toString().split('.');
    let suffix = angka[1] ? '.' + angka[1] : '';
    if (format) {
        let str = '';
        for (let i = 0; i <= format; i++) {
            const suffix_1 = suffix[i] ? suffix[i] : '';
            str = `${str}${suffix_1}`;
        }
        suffix = str;
    }

    angka = angka[0];
    if (angka[0]) {
        let number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi)

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? ',' : ''
            rupiah += separator + ribuan.join(',')
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
        const result = prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '')
        return result + suffix;
    }
    else {
        return 0
    }
}