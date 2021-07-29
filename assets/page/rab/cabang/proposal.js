$(document).ready(function () {
    function dynamic(start, end) {
        Loader();
        $.ajax({
            method: 'post',
            url: base_url + 'rab/proposal/ajax_data',
            data: {
                id: id_cabang,
            }
        }).done((data) => {
            const body = $("#list-body");
            body.empty();
            data.forEach(element => {
                body.append(`
                <li class="p-3 offline">
                <a class="d-flex list-rabs justify-content-between w-100" href="${base_url}rab/proposal/detail/${element.id_cabang}/${element.id}/${element.status}">
                <div class="chat-user-info">
                <h6 class="text-truncate mb-0">${element.judul}</h6>
                <div class="last-chat">
                <p class="text-truncate mb-0  fw-bold">${element.keterangan}</p>
                <p class="text-truncate mb-0  text-info fw-bold">RM ${format_ringgit(element.total_ringgit)}</p>
                </div>
                </div>
                <div class="last-chat">
                <p class="text-truncate mb-0  fw-bold">${element.tanggal}</p>
                <p class="text-truncate mb-0 fw-bold text-${(element.status == 0) ? "secondary" : ((element.status == 1) ? "warning" : ((element.status == 2) ? "primary" : ((element.status == 3) ? "danger" : ((element.status == 4) ? "success" : ""))))}">${(element.status == 0) ? "Diproses" : ((element.status == 1) ? "Diajukan" : ((element.status == 2) ? "Diterima" : ((element.status == 3) ? "Ditolak" : ((element.status == 4) ? "Dicairkan" : ""))))}</p>

                </div>
                </a>
                </li>
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

    // Clik Tambah
    $('#tambah').on('click', () => {
        // cek apakah sudah ada proposal atau belum
        $.ajax({
            method: 'post',
            url: base_url + 'rab/proposal/cekTambah',
            data: {
                id: id_cabang
            }
        }).done((data) => {
            if (data) {
                if (data.status == 2 && data.proposal == 0) {
                    $('#judul').val('')
                    $('#keterangan').val('')
                    $('#tambahModal').modal('toggle')
                } else if (data.proposal > 0) {
                    setToast('danger', 'warning', 'Failed', 'Mohon maaf, Proposal sudah ada. Terimakasih');
                } else {
                    setToast('danger', 'warning', 'Failed', 'Mohon maaf, Belum ada RAB yang disetujui. Terimakasih');
                }
            } else {
                $.failMessage('Gagal mendapatkan data.', 'Proposal')
            }
        }).fail(($xhr) => {
            setToast('danger', 'danger', 'Failed', 'Gagal mendapatkan data');
        })
    })

    $("#form").submit((ev) => {
        ev.preventDefault();
        $.ajax({
            method: 'post',
            url: base_url + 'rab/proposal/insert',
            data: {
                id_cabang: id_cabang,
                judul: $('#judul').val(),
                keterangan: $('#keterangan').val(),
                tanggal_dari: $("#detail-tgl-sampai").val(),
                tanggal_sampai: $("#detail-tgl-sampai").val(),
                termin: $("#termin").val(),
            }
        }).done((data) => {
            setToast('success', 'success', 'Success', 'Berhasil menambahkan data');
            $('#judul').val('')
            $('#keterangan').val('')
            dynamic()
        }).fail(($xhr) => {
            setToast('danger', 'danger', 'Failed', 'Gagal menambahkan data');
        }).always(() => {
            $('#tambahModal').modal('toggle')
        })
    });
});