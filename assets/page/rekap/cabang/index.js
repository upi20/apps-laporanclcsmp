let global_date_start = "";
let global_date_end = "";
let filter_data_tanggal = { start: global_date_start, end: global_date_end };
let initial = false;
let start, end;
if (moment().isAfter(moment().month("June").endOf('month'))) {
    // semester 2
    start = moment().month("July").startOf('month');
    end = moment().endOf('year');
} else {
    // semester 1
    start = moment().startOf('year');
    end = moment().month("June").endOf('month');
}

function cb(start, end) {
    $('#datepicker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    global_date_start = start.format('YYYY-MM-DD');
    global_date_end = end.format('YYYY-MM-DD');
    filter_data_tanggal = { start: global_date_start, end: global_date_end };
}

$('#datepicker').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
        'Hari ini': [moment(), moment()],
        'Semester 1': [moment().startOf('year'), moment().month("June").endOf('month')],
        'Semester 2': [moment().month("July").startOf('month'), moment().endOf('year')],
    }
}, cb);
cb(start, end);

$(document).ready(function () {

    function dynamic(start, end) {
        Loader();
        $.ajax({
            method: 'post',
            url: base_url + 'rekap/ajax_data',
            data: {
                cabang: id_cabang,
                tanggal: JSON.stringify({ start: start, end: end })
            }
        }).done((data) => {
            const body = $("#list-body");
            body.empty();
            data.data.forEach(element => {
                body.append(`
                <li class="p-3 offline">
                <a class="d-flex list-rabs justify-content-between w-100" href="#" data-id="${element.id}" onclick="event.preventDefault();">
                <div class="chat-user-info">
                <h6 class="text-truncate mb-0">${element.kode}</h6>
                <h6 class="text-truncate mb-0">RM ${element.harga_ringgit} | RP ${element.harga_rupiah}</h6>
                <div class="last-chat">
                <p class="text-truncate mb-0  fw-bold">${element.uraian}</p>
                </div>
                </div>
                <div class="last-chat">
                <p class="text-truncate mb-0 fw-bold">${element.tanggal}</p>
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
    dynamic(global_date_start, global_date_end);

    $("#btn-cari").click(() => dynamic(global_date_start, global_date_end));
    $("#btn-export").click(() => {
        location.href = base_url + `rekap/excel?start=${global_date_start}&end=${global_date_end}&cabang=${id_cabang}`;
    });
});