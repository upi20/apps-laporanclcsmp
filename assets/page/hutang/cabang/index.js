$(document).ready(function () {

    function dynamic() {
        Loader();
        $.ajax({
            method: 'post',
            url: base_url + 'hutang/ajax_data',
            data: null
        }).done((data) => {
            const body = $("#list-body");
            body.empty();
            data.data.forEach(element => {
                body.append(`
                <li class="p-3 offline">
                <a class="d-flex list-rabs justify-content-between w-100" href="#" data-id="${element.id}" onclick="event.preventDefault();handleListHutang(this);">
                <div class="chat-user-info">
                <h6 class="text-truncate mb-0">${element.nama}</h6>
                <div class="last-chat">
                <p class="text-truncate mb-0">RM ${element.jumlah}</p>
                </div>
                </div>
                <div class="last-chat">
                <p class="text-truncate mb-0 fw-bold text-${element.status == 1 ? "primary" : "danger"}">${element.status == 1 ? "Lunas" : "Belum Lunas"}</p>
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

    dynamic();

    // insert submit
    $('#formTambah').submit(function (ev) {
        ev.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: base_url + 'hutang/insert',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                setToast('success', 'primary', 'Success', 'Data Berhasil di tambahkan');
                $("#modalTambah").modal('toggle');
                dynamic();
            },
            error: function (data) {
                setToast('danger', 'danger', 'Failed', 'Data gagal di tambahkan');
                $("#modalTambah").modal('toggle');
            }
        });
    })

    // ubah submit
    $('#formDetail').submit(function (ev) {
        ev.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: base_url + 'hutang/update',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                setToast('success', 'primary', 'Success', 'Data Berhasil di ubah');
                $("#modalDetail").modal('toggle');
                dynamic();
            },
            error: function (data) {
                setToast('danger', 'danger', 'Failed', 'Data gagal di ubah');
                $("#modalDetail").modal('toggle');
            }
        });
    })

    // delete hutang
    $("#detail-btn-hapus").click(function () {
        if (confirm("Yakin akan menghapus data hutang")) {
            $.ajax({
                method: 'post',
                url: base_url + 'hutang/delete',
                data: {
                    id: $("#detail-id").val()
                }
            }).done((data) => {
                setToast('success', 'primary', 'Success', 'Data Berhasil di hapus');

                dynamic();

            })
                .fail(($xhr) => {
                    setToast('danger', 'danger', 'Failed', 'Data gagal di hapus');
                }).
                always(() => {
                    $("#modalDetail").modal('toggle');
                })
        }
    });

    // bayar hutang
    $('#bayar-hutang').on('click', () => {

        $.ajax({
            method: 'post',
            url: base_url + 'hutang/getSaldo',
            data: null
        }).done((data) => {
            if (data['jumlah_ringgit'] < 0) {
                $('#jumlah-saldo').val('RM -' + format_ringgit(data['jumlah_ringgit']))
            } else {
                $('#jumlah-saldo').val('RM ' + format_ringgit(data['jumlah_ringgit']))
            }
        })

        $.ajax({
            method: 'post',
            url: base_url + 'hutang/getTotalHutang',
            data: null
        }).done((data) => {
            $('#totalHutang').html('Total = RM ' + format_ringgit(data['sisa']))
            $('#dibayar').val('RM ' + format_ringgit(data['sisa']))

            if (data['sisa'] <= 0) {
                setToast('info', 'warning', 'Peringatan', 'Mohon maaf, saat ini tidak ada hutang. Terimakasih');
            } else {
                $('#modalBayarUtang').modal('toggle')
            }
        })


    })

    // Fungsi simpan
    $('#form-bayar-hutang').submit((ev) => {
        ev.preventDefault()

        let jumlah_saldo = $('#jumlah-saldo').val()
        let dibayar = $('#dibayar').val()

        $.ajax({
            method: 'post',
            url: base_url + 'hutang/bayar',
            data: {
                jumlah_saldo: jumlah_saldo,
                dibayar: dibayar,
                tanggal_administrasi: $('#tanggal-administrasi').val()
            }
        }).done((data) => {
            setToast('success', 'primary', 'Success', 'Berhasil dibayar');
            dynamic()

        })
            .fail(($xhr) => {
                setToast('danger', 'danger', 'Failed', 'Gagal dibayar');

            }).
            always(() => {
                $('#modalBayarUtang').modal('toggle')
            })
    })


})

function setReadonly(id, readonly = true) {
    if (readonly) {
        $("#" + id).attr("readonly", "");
    } else {
        $("#" + id).removeAttr("readonly");
    }
};

function setDisabled(id, disabled = true) {
    if (disabled) {
        $("#" + id).attr("disabled", "");
    } else {
        $("#" + id).removeAttr("disabled");
    }
};

function setHidden(id, hidden = true) {
    if (hidden) {
        $("#" + id).attr("style", "display:none;");
    } else {
        $("#" + id).removeAttr("style");
    }
};

function handleListHutang(data) {
    $("#modalDetail").modal("toggle");
    $.ajax({
        type: 'post',
        url: base_url + 'hutang/getDataDetail',
        data: {
            id: data.dataset.id
        }
    }).done(function (data) {
        $("#detail-nama").val(data.nama);
        $("#detail-id").val(data.id);
        $("#detail-no_hp").val(data.no_hp);
        $("#detail-keterangan").val(data.keterangan);
        $("#detail-jumlah").val(data.jumlah);
        $("#detail-tanggal").val(data.tanggal);
        $("#modalDetail").modal("toggle");

        const readonly = data.status == 1;
        setReadonly("detail-nama", readonly);
        setReadonly("detail-id", readonly);
        setReadonly("detail-no_hp", readonly);
        setReadonly("detail-keterangan", readonly);
        setReadonly("detail-jumlah", readonly);
        setReadonly("detail-tanggal", readonly);
        setDisabled("detail-btn-submit", readonly);
        setDisabled("detail-btn-hapus", readonly);
        setHidden("detail-btn-submit", readonly);
        setHidden("detail-btn-hapus", readonly);
    }).fail(function (data) {
        console.log(data);
    })

}