$(document).ready(function () {
    $("#dataTable").dataTable().fnDestroy();
    $("#dataTable").DataTable({
        "ajax": {
            "url": base_url + "rab/clc/ajax_data/",
            "data": null,
            "type": 'POST'
        },
        "scrollX": true,
        "processing": true,
        "serverSide": false,
        "columns": [
            { "data": "kodes" },
            { "data": "nama_aktifitas", className: "nowrap" },
            { "data": "jumlah_1" },
            { "data": "satuan_1" },
            { "data": "jumlah_2" },
            { "data": "satuan_2" },
            { "data": "jumlah_3" },
            { "data": "satuan_3" },
            { "data": "jumlah_4" },
            { "data": "satuan_4" },
            {
                "data": "harga_ringgit", render(data, type, full, meta) {
                    return '<p style="text-align:right">' + format_ringgit(data) + '<p>';
                }
            },
            {
                "data": "harga_rupiah", render(data, type, full, meta) {
                    return '<p style="text-align:right">' + format_rupiah(data) + '<p>';
                }
            },
            {
                "data": "total_harga_ringgit", render(data, type, full, meta) {
                    return '<p style="text-align:right">' + format_ringgit(data) + '<p>';
                }
            },
            {
                "data": "total_harga_rupiah", render(data, type, full, meta) {
                    return '<p style="text-align:right">' + format_rupiah(data) + '<p>';
                }
            },
            { "data": "keterangan" },
            {
                "data": "id", render(data, type, full, meta) {
                    if (full.fungsi == 0) {
                        return `<div class="pull-right">
                                    <button class="btn btn-primary btn-sm" onclick="Ubah(${data})">
                                        <i class="fa fa-edit"></i> Ubah
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="Hapus(${data})">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </div>`
                    } else {
                        return `-`
                    }
                }, className: "nowrap"
            }
        ],
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': ["no-sort"] }
        ]
    });
});