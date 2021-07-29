const my_footer = $("#footer-menu");
my_footer.find("li").each(function () {
    const menu = $(this);
    this.addEventListener("click", function () {
        Loader();
    });
    if (menu.data('name') == my_acctive_menu) {
        menu.addClass("active");
        $(this).find("a>i").addClass("text-warning");
        $(this).find("a>span").addClass("text-warning");
    } else {
        menu.find("a").prop("style", "color: #a3a3a3;");
        menu.find("span").prop("style", "color: #a3a3a3;");
    }
});


function Loader(isLoading = true) {
    if (isLoading) {
        $("#loader").html(`<div class="preloader d-flex align-items-center justify-content-center" id="preloader">
        <div class="spinner-grow text-warning" role="status">
        <div class="sr-only">Loading...</div>
        </div>
        </div>`)
    } else {
        $("#loader").empty();
    }
    return "loading..";
}

// document.querySelectorAll(".loader-class").forEach(function () {
//     this.addEventListener("click", function () {
//         Loader();
//     });
// })

window.addEventListener('popstate', function (event) {
    Loader();
});


function format_ringgit(angka, format = 2, prefix) {
    angka = angka != "" ? angka : 0;
    angka = parseFloat(angka);
    const minus = angka < 0 ? "-" : "";
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
        return minus + result + suffix;
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
        const result = prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        return minus + result + suffix;
    }
    else {
        return 0
    }
}
function element_disabled(id, disabled = true) {
    if (disabled) {
        $("#" + id).attr("disabled", "");
    } else {
        $("#" + id).removeAttr("disabled");
    }
}

function element_hidden(id, hidden = true) {
    if (hidden) {
        $("#" + id).attr("style", "display:none");
    } else {
        $("#" + id).removeAttr("style");
    }
}