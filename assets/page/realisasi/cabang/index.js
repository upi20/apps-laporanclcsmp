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

const data_send = new Map();

let id_rab_send = [];
let ringgit_send = [];
let rupiah_send = [];
let jumlah_ringgit_send = 0;
let jumlah_rupiah_send = 0;
{
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    $("#belanja-tanggal").val(yyyy + '-' + mm + "-" + dd);
}

function handleSetAllCheckbox(data) {
    $(".check").prop("checked", data.checked);
    setBtnUbah();
}

$(document).ready(function () {
    function dynamic() {
        // Loader();
        $.ajax({
            method: 'post',
            url: base_url + 'realisasi/realisasi/ajax_data',
            data: {
                npsn: npsn
            }
        }).done((data) => {
            const body = $("#list-body");
            body.empty();
            data.data.forEach(el => {
                let status = '';
                const is_proposal = el.proposal_jumlah_ringgit != undefined;
                let volume = 0;
                let ringgit = 0;
                let rupiah = 0;

                // jika ada proposal
                if (is_proposal) {
                    ringgit = el.proposal_jumlah_ringgit;
                    rupiah = el.proposal_jumlah_rupiah;
                    volume = el.proposal_volume;
                }
                // jika tidak ada proposal
                else {
                    // jika sudah rabs pernah direalisasi
                    if (el.vol_realisasi > 0) {
                        volume = el.vol_realisasi_sisa;
                        ringgit = volume * el.harga_ringgit;
                        rupiah = volume * el.harga_rupiah;
                    }
                    // jika rabs belum direalisasi
                    else {
                        volume = el.volume;
                        ringgit = el.total_harga_ringgit;
                        rupiah = el.total_harga_rupiah;
                    }
                }

                const btn_detail = `<button class="btn btn-warning btn-sm m-1" onclick="detail(${el.id_rab})" type="button">Detail</button>`;

                if ((!el.id_realisasi) || el.vol_realisasi_sisa > 0) {
                    status = `<input class="form-check-input me-2 check"
                    id="listCheckbox-${el.id}"
                    type="checkbox"
                    style="width: 25px; height: 25px; margin-right: 10px;"
                    data-id_rab="${el.id}"
                    data-kode="${el.kodes}"
                    data-volume="${volume}"
                    data-uraian="${el.nama_aktifitas}"
                    data-satuan_ringgit="${el.harga_ringgit}"
                    data-satuan_rupiah="${el.harga_rupiah}"
                    data-ringgit="${ringgit}"
                    data-rupiah="${rupiah}"
                    >${el.vol_realisasi > 0 ? btn_detail : ''}`;
                } else {
                    status = btn_detail;
                }
                body.append(`
                <label class="list-group-item d-flex" for="listCheckbox-${el.id}">
                ${status}
                <div class="chat-user-info">
                    <h6 class="text-truncate mb-0" style="font-size: 1em;">${el.kodes} | (RM ${format_ringgit(el.total_harga_ringgit)})</h6>
                    <div class="last-chat">
                        <p class="text-truncate mb-0" style="font-size: 1em;"> ${el.nama_aktifitas}</p>
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
                setToast('danger', 'danger', 'Failed', 'Data gagal mendapatkan data');
            }).
            always(() => {
                Loader(false);
            })
    }
    dynamic();


    $("#form").submit(function (ev) {
        ev.preventDefault();
        id_rab_send = [];
        ringgit_send = [];
        rupiah_send = [];
        let jml_ringgit = 0;
        let jml_rupiah = 0;

        let html_uraian = ``;

        let dataOk = false;

        $(".check").each(function () {
            if (this.checked) {
                const datas = this.dataset;
                jml_ringgit += Number(datas.ringgit);
                jml_rupiah += Number(datas.rupiah);
                dataOk = true;

                html_uraian += `
                <!-- title -->
                <tr style="font-weight:bold; text-align:center; border-top: 3px solid #f1b10f !important">
                    <td rowspan="1" colspan="2">${datas.kode} (${datas.uraian})</td>
                </tr>
                <!-- satuan rm -->
                <tr>
                    <td><label for="anggaran-harga-satuan-rm-${datas.id_rab}">Harga&nbsp;Satuan&nbsp;(RM)</label>
                        <input step="any" readonly="" type="number" class="form-control" id="anggaran-harga-satuan-rm-${datas.id_rab}"
                            value="${parseFloat(datas.satuan_ringgit)}" required="">
                    </td>
                    <td><label for="selisih-satuan-rm-${datas.id_rab}">Selisih Satuan (RM)</label>
                        <input step="any" readonly="" type="number" class="form-control" id="selisih-satuan-rm-${datas.id_rab}" value="0"
                            required="">
                    </td>
                </tr>
                <tr>
                    <td rowspan="1" colspan="2"><label for="realisasi-harga-satuan-rm-${datas.id_rab}">Harga Satuan Real (RM)</label>
                        <input step="any" type="number" class="form-control input-realisasi" data-id="${datas.id_rab}" data-tipe="satuan"
                            id="realisasi-harga-satuan-rm-${datas.id_rab}" value="${parseFloat(datas.satuan_ringgit)}" style="border-bottom:2px solid #333" required="">
                    </td>
                </tr>

                <!-- volume -->
                <tr>
                    <td><label for="anggaran-volume-${datas.id_rab}">Volume</label>
                        <input step="any" type="number" class="form-control" id="anggaran-volume-${datas.id_rab}" value="${datas.volume}" required=""
                            disabled="">
                    </td>
                    <td><label for="selisih-volume-${datas.id_rab}">Selisih Volume</label>
                        <input step="any" readonly="" type="number" class="form-control" id="selisih-volume-${datas.id_rab}" value="0"
                            required="">
                    </td>
                </tr>
                <tr>
                    <td rowspan="1" colspan="2"><label for="realisasi-volume-${datas.id_rab}">Volume Realisasi</label>
                        <input step="0" type="number" class="form-control input-realisasi" data-id="${datas.id_rab}" data-tipe="volume"
                            id="realisasi-volume-${datas.id_rab}" value="${datas.volume}" style="border-bottom:2px solid #333" required="">
                    </td>
                </tr>

                <!-- total anggaran rm -->
                <tr>
                    <td><label for="anggaran-rab-rm-${datas.id_rab}">Anggaran&nbsp;RAB&nbsp;(RM)</label>
                        <input step="any" readonly="" type="number" class="form-control" id="anggaran-rab-rm-${datas.id_rab}" value="${datas.ringgit}"
                            required="">
                    </td>
                    <td><label for="selisih-rab-rm-${datas.id_rab}">Selisih Anggaran(RM)</label>
                        <input step="any" readonly="" type="number" class="form-control" id="selisih-rab-rm-${datas.id_rab}" value="0"
                            required="">
                    </td>
                </tr>
                <tr>
                    <td rowspan="1" colspan="2"><label for="realisasi-total-rm-${datas.id_rab}">Total Realisasi (RM)</label>
                        <input step="any" readonly="" type="number" class="form-control" id="realisasi-total-rm-${datas.id_rab}" value="${datas.ringgit}"
                            required="">
                    </td>
                </tr>

                <!-- total anggaran rp-->
                <tr>
                    <td><label for="anggaran-rab-rp-${datas.id_rab}">Anggaran&nbsp;RAB&nbsp;(Rp)</label>
                        <input step="any" readonly="" type="number" class="form-control" id="anggaran-rab-rp-${datas.id_rab}" value="${datas.rupiah}"
                            required="">
                    </td>
                    <td><label for="selisih-rab-rp-${datas.id_rab}">Selisih Anggaran(Rp)</label>
                        <input step="any" readonly="" type="number" class="form-control" id="selisih-rab-rp-${datas.id_rab}" value="0"
                            required="">
                    </td>
                </tr>
                <tr style="border-bottom: 3px solid #f1b10f !important">
                    <td rowspan="1" colspan="2"><label for="realisasi-total-rp-${datas.id_rab}">Total Realisasi (Rp)</label>
                        <input step="any" readonly="" type="number" class="form-control" id="realisasi-total-rp-${datas.id_rab}" value="${datas.rupiah}"
                            required="">
                    </td>
                </tr>
                `;
            }
        });
        if (dataOk) {
            $("#body-realisasi").html(html_uraian);
            $("#belanja-harga-ringgit").val(jml_ringgit)
            $("#belanja-harga-rupiah").val(jml_rupiah)
            $("#belanja-text-total-ringgit").val('RM ' + format_ringgit(jml_ringgit, false))
            $("#belanja-text-total-rupiah").val('Rp ' + format_rupiah(jml_rupiah, false))

            $("#belanja-text-harga-ringgit").val('RM ' + format_ringgit(jml_ringgit, false))
            $("#belanja-text-harga-rupiah").val('Rp ' + format_rupiah(jml_rupiah, false))

            $(".input-realisasi").change(function () {
                refreshRealisasi(this);
            })
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
        // membuat data untuk kirim ke kontroler
        $(".check").each(function () {
            if (this.checked) {
                const data = this.dataset;
                const id = data.id_rab;

                // const anggaran_satuan = Number($(`#anggaran-harga-satuan-rm-${id}`).val());
                // const anggaran_volume = Number($(`#anggaran-volume-${id}`).val());
                // const anggaran_rab_rm = Number($(`#anggaran-rab-rm-${id}`).val());
                // const anggaran_rab_rp = Number($(`#anggaran-rab-rp-${id}`).val());

                const realisasi_satuan = Number($(`#realisasi-harga-satuan-rm-${id}`).val());
                const realisasi_volume = Number($(`#realisasi-volume-${id}`).val());
                const realisasi_total_rm = Number($(`#realisasi-total-rm-${id}`).val());
                const realisasi_total_rp = Number($(`#realisasi-total-rp-${id}`).val());

                const selisih_satuan = Number($(`#selisih-satuan-rm-${id}`).val());
                const selisih_volume = Number($(`#selisih-volume-${id}`).val());
                const selisih_total_rm = Number($(`#selisih-rab-rm-${id}`).val());
                const selisih_total_rp = Number($(`#selisih-rab-rp${id}`).val());

                // sisa ringgit Selisih Satuan (RM) * Volume Realisasi
                const sisa_ringgit = selisih_satuan * realisasi_volume;
                // sisa rupiah (sisa ringgit * kurs)
                const sisa_rupiah = sisa_ringgit * kurs;

                data_send.set(id, {
                    // table rabb---
                    // vol realisasi
                    vol_realisasi: realisasi_volume,
                    // vol relisasi sisa
                    vol_realisasi_sisa: selisih_volume,
                    // table realisasis---
                    // real harga
                    // total
                    harga_ringgit: realisasi_total_rm,
                    harga_rupiah: realisasi_total_rp,
                    // satuan
                    real_harga_ringgit: realisasi_satuan,
                    real_harga_rupiah: realisasi_satuan * kurs,

                    // sisa
                    sisa_ringgit: sisa_ringgit,
                    sisa_rupiah: sisa_rupiah,
                    // satuan real

                });


            }
        });

        var formData = new FormData(this);
        let id = $('#form input[name=id]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'realisasi/realisasi/insertUpload',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (gambar) {
                const real_ringgit = $("#belanja-harga-ringgit").val();
                const real_rupiah = $("#belanja-harga-rupiah").val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'realisasi/realisasi/insert',
                    data: {
                        data: JSON.stringify({
                            gambar: gambar.name,
                            nama: "Dibayarkan Kepada " + $("#belanja-nama").val() + " Untuk " + $("#belanja-nama1").val(),
                            tanggal: $("#belanja-tanggal").val(),
                            keterangan: $("#belanja-keterangan").val(),
                            id_cabang: id_cabang,
                            realisasi: Object.fromEntries(data_send),
                            total_ringgit: real_ringgit,
                            total_rupiah: real_rupiah
                        })
                    },
                    success: function (data) {
                        setToast('success', 'primary', 'Success', 'Data Berhasil Diubah');
                        $('#fullscreenModal').modal('toggle');
                        dynamic();
                        // location.reload();
                    },
                    error: function (data) {
                        setToast('danger', 'danger', 'Failed', 'Data Gagal Dibuah');
                        $('#fullscreenModal').modal('toggle');
                        dynamic();
                        // location.reload();
                    }
                });
            },
            error: function (data) {
                setToast('danger', 'danger', 'Failed', 'Data Gagal Dibuah');
                $('#fullscreenModal').modal('toggle');
                dynamic();
            }
        });

    });
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

function format_rupiah(angka, format = 2, prefix) {
    angka = angka != "" ? angka : 0;
    angka = parseFloat(angka);
    const minus = angka < 0 ? "-" : "";
    angka = angka.toString().split('.');
    let suffix = angka[1] ? ',' + angka[1] : '';

    if (format) {
        let str = '';
        for (let i = 0; i <= format; i++) {
            const suffix_1 = suffix[i] ? suffix[i] : '';
            str = `${str}${suffix_1}`;
        }
        suffix = str;
    }

    angka = angka[0];
    if (angka) {
        let number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi)

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : ''
            rupiah += separator + ribuan.join('.')
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah

        // return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
        const result = prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
        return minus + result + suffix;
    }
    else {
        return 0
    }
}

function refreshRealisasi(data) {
    // menyiapkan variabel
    const id = data.dataset.id;
    const tipe = data.dataset.tipe;

    const anggaran_volume = Number($(`#anggaran-volume-${id}`).val());
    const anggaran_satuan = Number($(`#anggaran-harga-satuan-rm-${id}`).val());

    const realisasi_volume = Number($(`#realisasi-volume-${id}`).val());
    const realisasi_satuan = Number($(`#realisasi-harga-satuan-rm-${id}`).val());

    const anggaran_rm = Number($(`#anggaran-rab-rm-${id}`).val());
    const anggaran_rp = Number($(`#anggaran-rab-rp-${id}`).val());


    let total_rm = 0;
    let val = Number(data.value);
    let max = 0;

    // cek tipe inputan
    if (tipe == "volume") {
        max = anggaran_volume;
        if (val > max) {
            data.value = max;
            val = max;
        }
        if (val < 1) {
            data.value = 1;
            val = 1;
        }
    } else if (tipe == "satuan") {
        max = anggaran_satuan;
        if (val < 0) {
            data.value = 0;
            val = 0;
        }
    }

    // hitung realisasi rm
    if (tipe == "volume") {
        total_rm = realisasi_satuan * data.value;
    } else if (tipe == "satuan") {
        total_rm = realisasi_volume * data.value;
    }

    $(`#realisasi-total-rm-${id}`).val(total_rm)

    // hitung ralisasi rp
    const total_rp = total_rm * kurs;
    $(`#realisasi-total-rp-${id}`).val(total_rp)


    // hitung selisih
    if (tipe == "volume") {
        $(`#selisih-volume-${id}`).val(max - val)
    } else if (tipe == "satuan") {
        $(`#selisih-satuan-rm-${id}`).val(max - val)
    }

    // hitung selisih anggaran rm
    $(`#selisih-rab-rm-${id}`).val(anggaran_rm - total_rm)


    // hitung selisih anggaran rp
    $(`#selisih-rab-rp-${id}`).val(anggaran_rp - total_rp)

    if ($(`#selisih-satuan-rm-${id}`).val() == 0 && $(`#selisih-volume-${id}`).val() == 0) {
        $(`#selisih-rab-rp-${id}`).val(0);
        $(`#selisih-rab-rm-${id}`).val(0);
        $(`#realisasi-total-rp-${id}`).val(anggaran_rp)
        $(`#realisasi-total-rm-${id}`).val(anggaran_rm)
    }

    refreshTotal();
}

function refreshTotal() {
    // get total rab rm dan rp
    let total_rp = 0;
    let total_rm = 0;
    $(".check").each(function () {
        if (this.checked) {
            const data = this.dataset;
            const id = data.id_rab;
            const realisasi_rm = Number($(`#realisasi-total-rm-${id}`).val());
            const realisasi_rp = Number($(`#realisasi-total-rp-${id}`).val());
            total_rm += realisasi_rm;
            total_rp += realisasi_rp;


        }
    })
    $("#belanja-harga-ringgit").val(total_rm)
    $("#belanja-text-harga-ringgit").val('RM ' + format_ringgit(total_rm, false))
    $("#belanja-harga-rupiah").val(total_rp)
    $("#belanja-text-harga-rupiah").val('Rp ' + format_rupiah(total_rp, false))
}


function detail(id) {
    $.ajax({
        method: 'post',
        url: base_url + 'realisasi/realisasi/getDetailRealisasi',
        data: {
            id: id
        }
    }).done((data) => {
        let str_html = ``;
        let title = '';
        if (data) {
            data.forEach(e => {
                title = `${e.kode} (${e.title_nama})`;
                str_html += `
                            <tr style="font-weight:bold; text-align:center; border-top: 3px solid #f1b10f !important">
                                <td rowspan="1" colspan="2"><strong>Tanggal:</strong>  ${e.tanggal}</td>
                            </tr>
                            <tr>
                                <td rowspan="1" colspan="2"><strong>Uraian:</strong> ${e.nama}</td>
                            </tr>
                            <tr>
                                <td rowspan="1" colspan="2"><strong>Keterangan:</strong> ${e.keterangan}</td>
                            </tr>
                            <tr>
                                <td rowspan="1" colspan="2"><strong>Photo Resit / Nota / Kwitansi:</strong> <a href="${base_url + 'gambar/' + e.gambar}"
                                        target="_blank">Download</a></td>
                            </tr>
                            <tr>
                                <td><label for="anggaran-harga-satuan-rm-${e.id}">Harga&nbsp;Satuan&nbsp;(RM)</label>
                                    <input step="any" readonly="" type="text" class="form-control"
                                        id="anggaran-harga-satuan-rm-${e.id}" value="${"RM " + format_ringgit(e.anggaran_satuan)}" required="">
                                </td>
                                <td><label for="realisasi-harga-satuan-rm-${e.id}">Harga Satuan Real (RM)</label>
                                    <input step="any" type="text" class="form-control input-realisasi" data-id="34"
                                        data-tipe="satuan" id="realisasi-harga-satuan-rm-${e.id}" value="${"RM " + format_ringgit(e.realisasi_satuan)}" readonly
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="anggaran-volume-${e.id}">Volume</label>
                                    <input step="any" type="text" class="form-control" id="anggaran-volume-${e.id}"
                                        value="${e.anggaran_volume}" required="" disabled="">
                                </td>
                                <td><label for="realisasi-volume-${e.id}">Volume Realisasi</label>
                                    <input step="0" type="text" class="form-control input-realisasi" data-id="34"
                                        data-tipe="volume" id="realisasi-volume-${e.id}" value="${e.realisasi_volume}" readonly required="">
                                </td>
                            </tr>
                            <tr>
                                <td><label for="anggaran-rab-rm-${e.id}">Anggaran&nbsp;RAB&nbsp;(RM)</label>
                                    <input step="any" readonly="" type="text" class="form-control"
                                        id="anggaran-rab-rm-${e.id}" value="${"RM " + format_ringgit(e.anggaran_total_rm)}" required="">
                                </td>
                                <td><label for="realisasi-total-rm-${e.id}">Total Realisasi (RM)</label>
                                    <input step="any" readonly="" type="text" class="form-control"
                                        id="realisasi-total-rm-${e.id}" value="${"RM " + format_ringgit(e.realisasi_total_rm)}" required="">
                                </td>
                            </tr>
                            <tr style="border-bottom: 3px solid #f1b10f !important">
                                <td><label for="anggaran-rab-rp-${e.id}">Anggaran&nbsp;RAB&nbsp;(Rp)</label>
                                    <input step="any" readonly="" type="text" class="form-control"
                                        id="anggaran-rab-rp-${e.id}" value="${"Rp " + format_rupiah(e.anggaran_total_rp)}" required="">
                                </td>
                                <td><label for="realisasi-total-rp-${e.id}">Total Realisasi (Rp)</label>
                                    <input step="any" readonly="" type="text" class="form-control"
                                        id="realisasi-total-rp-${e.id}" value="${"Rp " + format_rupiah(e.realisasi_total_rp)}" required="">
                                </td>
                            </tr>
                `;

            });
        }
        $('#modalDetailLabel').html(`Detail Realisasi | ${title}`);
        $('#detail-realisasi-modal').html(str_html);

        $('#modalDetail').modal('toggle')
    })
        .fail(($data) => {
            setToast('danger', 'danger', 'Failed', 'Gagal mendapatkan data.')
        })
}