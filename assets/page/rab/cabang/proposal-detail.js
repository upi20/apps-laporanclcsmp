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

let global_id_rabs = [];
let global_ringgit = [];
let global_rupiah = [];
let global_total_ringgit = 0;
let global_total_rupiah = 0;
let global_oke_ajukan = true;

$(document).ready(function () {

    $(".check").on('change', function () {
        setBtnUbah();
        global_oke_ajukan = false;
    });

    $("#judul").on('change', function () {
        global_oke_ajukan = false;
    });

    $("#keterangan").on('change', function () {
        global_oke_ajukan = false;
    });
    $("#detail-tgl-dari").on('change', function () {
        global_oke_ajukan = false;
    });
    $("#detail-tgl-sampai").on('change', function () {
        global_oke_ajukan = false;
    });
    $("#termin").on('change', function () {
        global_oke_ajukan = false;
    });

    $("#form").submit(function (ev) {
        ev.preventDefault();
        // validasi judul
        const judul = $("#judul");
        if (judul.val() == "") {
            setToast('danger', 'danger', 'Failed', 'Judul wajid di isi');
            judul.focus();
            return;
        }

        // validasi keterangan
        const keterangan = $("#keterangan");
        if (keterangan.val() == "") {
            setToast('danger', 'danger', 'Failed', 'Keterangan wajid di isi');
            keterangan.focus();
            return;
        }

        // validasi termin dari
        const tanggal_dari = $("#detail-tgl-dari");
        if (tanggal_dari.val() == "") {
            setToast('danger', 'danger', 'Failed', 'Tanggal dari Wajib di isi.')
            tanggal_dari.focus();
            return;
        }

        // validasi termin sampai
        const tanggal_sampai = $("#detail-tgl-sampai");
        if (tanggal_sampai.val() == "") {
            setToast('danger', 'danger', 'Failed', 'Tanggal sampai Wajib di isi.')
            tanggal_sampai.focus();
            return;
        }

        // validasi termin
        const termin = $("#termin");
        if (termin.val() == "") {
            setToast('danger', 'danger', 'Failed', 'Termin Wajib di isi.')
            termin.focus();
            return;
        }

        // data proposal
        const id_proposal = $("#id-proposal");

        // collect data rabs
        const id_rabs = [];
        const ringgit = [];
        const rupiah = [];
        const jumlah_1 = [];
        const jumlah_1_realisasi = [];
        const jumlah_1_sisa = [];
        const rabs_sisa_id_proposal = [];
        const rabs_sisa_id_proposal_rab = [];

        let total_ringgit = 0;
        let total_rupiah = 0;

        $(".check").each(function () {
            if (this.checked) {
				rabs_sisa_id_proposal.push(this.dataset.id_proposal == "" ? 0 : this.dataset.id_proposal);
				rabs_sisa_id_proposal_rab.push(this.dataset.id_proposal_rab == "" ? 0 : this.dataset.id_proposal_rab);
				const id = this.dataset.id;
				const jumlah_1_val = Number(this.dataset.jumlah_1);
				const jumlah_1_realisasi_val = Number($("#input-realisasi-" + id).val());

				const ringgit_rab = parseFloat(this.dataset.ringgit) * jumlah_1_realisasi_val;
				const rupiah_rab = parseFloat(this.dataset.rupiah) * jumlah_1_realisasi_val;

				id_rabs.push(this.dataset.id);

				ringgit.push(ringgit_rab);
				rupiah.push(rupiah_rab);

				total_ringgit += ringgit_rab;
				total_rupiah += rupiah_rab;

				jumlah_1.push(jumlah_1_val);
				jumlah_1_realisasi.push(jumlah_1_realisasi_val);
				jumlah_1_sisa.push(jumlah_1_val - jumlah_1_realisasi_val);
            }
        });

        $("#total-rm").text("RM " + format_ringgit(global_total_ringgit));

		const rabs = JSON.stringify({
			id_rabs: id_rabs,
			ringgit: ringgit,
			rupiah: rupiah,
			jumlah_1: jumlah_1,
			jumlah_1_realisasi: jumlah_1_realisasi,
			jumlah_1_sisa: jumlah_1_sisa,
			sisa_id_proposal: rabs_sisa_id_proposal,
			sisa_id_proposal_rab: rabs_sisa_id_proposal_rab
		});

        // return;
        $.ajax({
            method: 'post',
            url: base_url + 'rab/proposal/update',
            data: {
				id_proposal: id_proposal.val(),
				id_cabang: global_id_cabang,
				judul: judul.val(),
				keterangan: keterangan.val(),
				rabs: rabs,
				ringgit: total_ringgit,
				rupiah: total_rupiah,
				tanggal_dari: tanggal_dari.val(),
				tanggal_sampai: tanggal_sampai.val(),
				termin: termin.val(),
            }
        }).done((data) => {
            global_oke_ajukan = true;
            setToast('success', 'success', 'Success', 'Proposal berhasil disimpan');
        }).fail(($xhr) => {
            setToast('danger', 'danger', 'Failed', 'Proposal gagal disimpan');
        })

    });

    $(".list-rm").each(function () {
        $(this).text("RM " + format_ringgit(parseFloat($(this).text())));
    });

    $("#btn-ajukan").on('click', function () {
        if (global_oke_ajukan) {
            $("#ajukanModal").modal("toggle");
        } else {
            setToast('info', 'warning', 'Failed', 'Terdapat data yang belum disimpan');
        }
    });

    $("#btn-ajukan-submit").on('click', function () {
        $.ajax({
            method: 'post',
            url: base_url + 'rab/proposal/ajukan',
            data: {
                id_proposal: $("#id-proposal").val()
            }
        }).done((data) => {
            setToast('success', 'success', 'Success', 'Proposal berhasil diajukan');
            setTimeout(function () {
                window.location.href = base_url + 'rab/proposal';
            }, 2000)

        }).fail(($xhr) => {
            setToast('danger', 'danger', 'Failed', 'Proposal gagal diajukan');
        }).always(() => {
            $("#ajukanModal").modal("toggle");
        })
    });

    $("#btn-hapus-submit").on('click', function () {
        $.ajax({
            method: 'post',
            url: base_url + 'rab/proposal/delete',
            data: {
                id_proposal: $("#id-proposal").val()
            }
        }).done((data) => {
            setToast('success', 'success', 'Success', 'Proposal berhasil dihapus');
            setTimeout(function () {
                location.href = base_url + "rab/proposal";
            }, 2000)

        }).fail(($xhr) => {
            setToast('danger', 'danger', 'Failed', 'Proposal gagal dihapus');
        }).always(() => {
            $("#hapusModal").modal("toggle");
        })
    });

    const total_rm = $("#total-rm")
    total_rm.text("RM " + format_ringgit(parseFloat(total_rm.text())));

    $(".input-jumlah-proposal").on('change', function () {
        let value = Number(this.value);
        const max = this.dataset.max;
        const id = this.dataset.id;

        if (value < 1) {
            this.value = 1;
            value = 1;
        }

        if (value > max) {
            this.value = max;
            value = max;
        }

        const total = value * parseFloat(this.dataset.ringgit);

        $("#input-realisasi-total-" + id).html("RM " + format_ringgit(total));
        $("#input-realisasi-total-val-" + id).val(total);
        setBtnUbah()
    });
});

function handleSetAllCheckbox(data) {
    $(".check").prop("checked", data.checked);
    setBtnUbah();
    global_oke_ajukan = false;
}

function setBtnUbah() {
    cekSaldo();
    global_oke_ajukan = false;
}

function cekSaldo() {
	let jumlah_total_ringgit = 0;
	let jumlah_total_rupiah = 0;
	$(".check").each(function () {
		if (this.checked) {
			const jumlah_1_realisasi = Number($("#input-realisasi-" + this.dataset.id).val());
			const jumlah_1_ringgit = parseFloat(this.dataset.ringgit);
			const jumlah_1_rupiah = parseFloat(this.dataset.rupiah);
			jumlah_total_ringgit += (jumlah_1_realisasi * jumlah_1_ringgit);
			jumlah_total_rupiah += (jumlah_1_realisasi * jumlah_1_rupiah);

			global_total_ringgit = jumlah_total_ringgit;
			global_total_rupiah = jumlah_total_rupiah;
		}
	});
	$("#total-rm").text("RM " + format_ringgit(jumlah_total_ringgit));
}