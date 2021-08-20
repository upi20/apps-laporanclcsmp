$(document).ready(function () {
    $("#kode").attr("readonly", "");
    function dynamic() {
        Loader();
        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getlistdatarabs',
            data: {
                id: id_cabang
            }
        }).done((data) => {
            const body = $("#list-body");
            body.empty();
            data.forEach(element => {
                body.append(`
                <li class="p-3 offline">
                <a class="d-flex list-rabs w-100" href="#" data-id="${element.id}" onclick="event.preventDefault();handleListRabs(this);">
                    <div class="chat-user-info">
                        <h6 class="text-truncate mb-0">${element.kode} | (RM ${format_ringgit(element.total_harga_ringgit)})</h6>
                        <div class="last-chat">
                            <p class="text-truncate mb-0"> ${element.nama}</p>
                        </div>
                    </div>
                </a>
            </li>
                `);
            });
        })
            .fail(($xhr) => {
                setToast('danger', 'danger', 'Failed', 'Gagal mendapatkan data');
            }).
            always(() => {
                Loader(false);
            })
    }

    $("#btn-reset-rab").click(() => {
        $("#modal-reset").modal('toggle');
    })

    $("#form-reset-rab").submit(function (ev) {
        ev.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: base_url + 'rab/clc/resetRab',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                setToast('success', 'primary', 'Success', 'RAB berhasil di reset');
                $("#modal-reset").modal('toggle');
                dynamic();
            },
            error: function (data) {
                setToast('danger', 'danger', 'Failed', 'RAB gagal di reset');
                $("#modal-reset").modal('toggle');
            }
        });
    })

    dynamic();
    // import submit
    $('#form-import').submit(function (ev) {
        ev.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: base_url + 'rab/clc/importFromExcel',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.code == 0) {
                    setToast('success', 'primary', 'Success', 'Data Berhasil di import');
                    $("#file").empty();
                } else {
                    setToast('danger', 'danger', 'Failed', 'Data gagal di import');
                }
                $("#importModal").modal('toggle');
                dynamic();
            },
            error: function (data) {
                setToast('danger', 'danger', 'Failed', 'Data gagal di import');
                $("#importModal").modal('toggle');
            }
        });
    })
    // ubah submit
    $('#form').submit(function (ev) {
        ev.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: base_url + 'rab/clc/update',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                setToast('success', 'primary', 'Success', 'Data Berhasil di ubah');
                $("#modal").modal('toggle');
                dynamic();
            },
            error: function (data) {
                setToast('danger', 'danger', 'Failed', 'Data gagal di ubah');
                $("#modal").modal('toggle');
            }
        });
    })

    const refreshTotal = () => {
        const harga_ringgit = parseFloat($("#val_harga_ringgit").val());
        const harga_rupiah = parseFloat($("#val_harga_rupiah").val());
        const jumlah_1 = Number($("#jumlah_1").val())
        const jumlah_2 = Number($("#jumlah_2").val())
        const jumlah_3 = Number($("#jumlah_3").val())
        const jumlah_4 = Number($("#jumlah_4").val())

        const rupiah_total = harga_rupiah * jumlah_1 * jumlah_2 * jumlah_3 * jumlah_4;
        const ringgit_total = harga_ringgit * jumlah_1 * jumlah_2 * jumlah_3 * jumlah_4;

        // view value
        $("#total_harga_ringgit").val('RM ' + format_ringgit(ringgit_total.toFixed(2)))
        $("#total_harga_rupiah").val('Rp ' + format_rupiah(rupiah_total.toFixed(2)))

        // value send
        $("#val_total_harga_ringgit").val(ringgit_total)
        $("#val_total_harga_rupiah").val(rupiah_total)
    }

    $('#harga_ringgit').on('change', function () {
        const value = this.value || 0;
        $.ajax({
            method: 'post',
            url: base_url + 'rab/clc/getkurs',
            data: {
                ringgit: value,
            },
        }).done((data) => {
            // let data = JSON.parse(data);
            let harga_ringgit = value;

            $("#harga_ringgit").val(value)
            $("#harga_rupiah").val(data.rupiah)

            $("#val_harga_ringgit").val(value)
            $("#val_harga_rupiah").val(data.rupiah)

            $("#total_harga_ringgit").val('RM ' + format_ringgit(value))
            $("#total_harga_rupiah").val('Rp ' + format_rupiah(data.rupiah))

            $("#val_total_harga_ringgit").val(harga_ringgit)
            $("#val_total_harga_rupiah").val(data.rupiah)
            refreshTotal();
        }).fail(($xhr) => {
            // console.log($xhr)
        })
    })

    $('#jumlah_1').on('change', function () {
        refreshTotal();
    })

    $('#jumlah_2').on('change', function () {
        refreshTotal();
    })

    $('#jumlah_3').on('change', function () {
        refreshTotal();
    })

    $('#jumlah_4').on('change', function () {
        refreshTotal();
    })
})
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