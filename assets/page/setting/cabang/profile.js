let global_new_password_status = false;
let global_curren_password_status = false;
$(document).ready(function () {
    $.ajax({
        method: 'post',
        url: base_url + 'setting/profile/ajax_data',
        data: {
            user_id: user_id,
        },
    }).done((data) => {
        $("#kode").val(data.kode);
        $("#id").val(data.id);
        $("#nama").val(data.nama);
        $("#no_telpon").val(data.no_telpon);
        $("#alamat").val(data.alamat);
        $("#jumlah_kelas_7").val(data.jumlah_kelas_7);
        $("#jumlah_kelas_8").val(data.jumlah_kelas_8);
        $("#jumlah_kelas_9").val(data.jumlah_kelas_9);
        $("#total_jumlah_siswa").val(data.total_jumlah_siswa);
        $("#jumlah_guru_bina").val(data.jumlah_guru_bina);
        $("#jumlah_guru_pamong").val(data.jumlah_guru_pamong);
        $("#total_jumlah_guru").val(data.total_jumlah_guru);
    }).fail(($xhr) => {
        setToast('danger', 'danger', 'Failed', 'Gagal mendapatkan data');
    })

    // jumlah siswa
    const jumlah_kelas_7 = $("#jumlah_kelas_7");
    const jumlah_kelas_8 = $("#jumlah_kelas_8");
    const jumlah_kelas_9 = $("#jumlah_kelas_9");
    const total_jumlah_siswa = $("[name=total_jumlah_siswa]");
    jumlah_kelas_7.keyup(function () {
        sumSiswa();
    });
    jumlah_kelas_8.keyup(function () {
        sumSiswa();
    });
    jumlah_kelas_9.keyup(function () {
        sumSiswa();
    });
    function sumSiswa() {
        total_jumlah_siswa.val(Number(jumlah_kelas_7.val()) + Number(jumlah_kelas_8.val()) + Number(jumlah_kelas_9.val()));
    }

    // jumlah guru
    const guru_bina = $("#jumlah_guru_bina");
    const guru_pamong = $("#jumlah_guru_pamong");
    const total_jumlah_guru = $("#total_jumlah_guru");
    guru_bina.keyup(function () {
        sumGuru();
    });
    guru_pamong.keyup(function () {
        sumGuru();
    });

    function sumGuru() {
        total_jumlah_guru.val(Number(guru_bina.val()) + Number(guru_pamong.val()));
    }

    // simpan profile
    // simpan
    $('#form').submit(function (evt) {
        evt.preventDefault();

        var formData = new FormData(this);
        let id = $('#form input[name=id]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'setting/profile/update',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data) {
                    setToast('success', 'primary', 'Success', 'Data Berhasil Diubah');
                } else {
                    setToast('danger', 'danger', 'Failed', 'Data gagal diubah');
                }
            },
            error: function (data) {
                setToast('danger', 'danger', 'Failed', 'Data gagal diubah');
            }
        });

    });

    const cekBtn = () => {
        if (global_curren_password_status && global_new_password_status) {
            element_disabled("btn-submit", false);
        } else {
            element_disabled("btn-submit");
        }
    }

    $("#current_password").on('change', function () {
        $.ajax({
            method: 'post',
            url: base_url + 'setting/profile/cek_password',
            data: {
                current_password: this.value
            },
        }).done((data) => {
            global_curren_password_status = (data);
            if (data) {
                setToast('success', 'primary', 'Success', 'Password sebelumnya benar.');
            } else {
                setToast('danger', 'danger', 'Failed', 'Password sebelumnya salah.');
            }
            cekBtn();
        }).fail(($xhr) => {
            console.log($xhr)
        })
    })

    $("#password_visibility").on('change', function () {
        let type = "password";
        if (this.checked) {
            type = "text";
        } else {
            type = "password";
        }
        $("#current_password").attr("type", type);
        $("#new_password").attr("type", type);
        $("#new_password_verify").attr("type", type);
    })

    // cek ulangi password
    $("#new_password_verify").on('change', function () {
        if (($("#new_password").val() == this.value) && (this.value != "")) {
            global_new_password_status = true;
            setToast('success', 'primary', 'Success', 'Ulangi Password benar.');
        } else {
            global_new_password_status = false;
            setToast('danger', 'danger', 'Failed', 'Ulangi Password salah.');
        }
        cekBtn();
    })

    // cek ulangi password
    $("#new_password").on('change', function () {
        global_new_password_status = false;
        $("#new_password_verify").val("");
        cekBtn();
    })

    // submit password
    $("#input_pengaturan").on('submit', function (ev) {
        ev.preventDefault();
        $.ajax({
            method: 'post',
            url: base_url + 'setting/profile/update_password',
            data: {
                new_password: $("#new_password").val()
            },
        }).done((data) => {
            if (data) {
                setToast('success', 'primary', 'Success', 'Password password berhasil diganti');
            } else {
                setToast('danger', 'danger', 'Failed', 'Password password gagal diganti');
            }
            $("#current_password").val("");
            $("#new_password").val("");
            $("#new_password_verify").val("");
            element_disabled("btn-submit");
        }).fail(($xhr) => {
            console.log($xhr)
        })
    })
})